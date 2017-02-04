<?php

namespace LACC\Http\Controllers;

use Illuminate\Http\Request;
use LACC\Models\Address;
use LACC\Models\City;
use LACC\Http\Requests\UserRequest;
use LACC\Models\State;
use LACC\Models\User;
use Illuminate\Database\Connection;

class UsersController extends Controller
{
    private $with = [ 'address' ];


    /**
     * @var \LACC\Models\State
     */
    protected $state;
    /**
     * @var City
     */
    protected $city;

    protected $bd;

    public function __construct( State $state, City $city, Connection $connection )
    {
         $this->state = $state;
         $this->city  = $city;
         $this->bd    = $connection;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->paginate( 10 );

        return view( 'users.index', compact( 'users' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities      = $this->getListCities();
        $civilStatus = $this->getPrepareListCivilStatus();
        $typeAddress = $this->getPrepareListTypeAddress();

        return view( 'users.create', compact( 'cities','civilStatus','typeAddress' ));
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        try{
            $this->bd->beginTransaction();
            $data = $request->all();
            //alterar a funcionalidade para que o password seja opciona!!!
            $data[ 'password' ] = ( $data['password'] ) ? $data['password'] : $this->setEncryptPassword( '123456' );

            $user = User::create($data);

            if( $user ){
                $data['user_id'] = $user->id;
                Address::create($data);
            }
            $this->bd->commit();

            $request->session()->flash('message', ['type' => 'success','msg'=> "User '{$data['name']}' successfully registered!"]);

            return redirect()->route( 'users.index' );
        } catch (\Exception $e){
            $this->bd->rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        if( !( $user = User::where( 'id', $id )->with( $this->with )->first() ) ){
            throw new ModelNotFoundException( 'User not found' );
        }

        return view( 'users.detail',compact( 'user' ) );
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        if( !( $user = User::find( $id ) ) ){
            throw new ModelNotFoundException( 'User not found' );
        }

        $addressUser = Address::where('user_id',$user->id)->first();
        if( $addressUser ){
            $user['city_id']      = $addressUser->city_id;
            $user['address']      = $addressUser->address;
            $user['district']     = $addressUser->district;
            $user['cep']          = $addressUser->cep;
            $user['type_address'] = $addressUser->type_address;
        }


        $cities      = $this->getListCities();
        $civilStatus = $this->getPrepareListCivilStatus();
        $typeAddress = $this->getPrepareListTypeAddress();

        return view( 'users.edit',compact( 'user', 'states','cities','civilStatus','typeAddress' ) );
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        try{
            if( !( $user = User::find( $id ) ) ){
                throw new ModelNotFoundException( 'User not found' );
            }

            $this->bd->beginTransaction();
            $data = $request->all();
            //alterar a funcionalidade para que o password seja opciona!!!
            $data[ 'password' ] = ( $data['password'] ) ? $data['password'] : $this->setEncryptPassword( '123456' );

            $user = $user->fill($data);
            $user->save();

            if( $user ){

                if( !( $address = Address::where( 'user_id', $user->id )->first() ) ){
                    throw new ModelNotFoundException( 'Address not found' );
                }

                $data['city_id'] = 6;
                $address =  $address->fill( $data );
                $address->save();
            }
            $this->bd->commit();

            $urlTo = $this->checksTheCurrentUrl( $data['redirect_to'] );
            $request->session()->flash('message', ['type' => 'success','msg'=> "User '{$data['name']}' successfully updated!"]);

            return redirect()->to( $urlTo );

        } catch (\Exception $e){
            $this->bd->rollBack();
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        if ( !( $user = User::find( $id ) ) ) {
            throw new ModelNotFoundException( 'User not found.' );
        }

        $user->delete();

        $request->session()->flash('message', ['type' => 'success','msg'=> 'User deleted successfully!']);

        return redirect()->route( 'users.index' );
    }

    private function getListCities()
    {
        $cities = [ '' => '--Select an city--' ];
        $cities += $this->city->orderBy( 'nom_city', 'ASC' )->pluck( 'nom_city','id' )->all();

        return $cities;
    }


    public function getPrepareListCivilStatus()
    {
        $arrStatus = [
            ''  => '--Select a civil status--',
            '1' => User::CASADO,
            '2' => User::VIUVO,
            '3' => User::DIVORCIADO,
            '4' => User::SOLTEIRO,
            '5' => User::UNKNOWN,
        ];
        return $arrStatus;
    }

    public function getPrepareListTypeAddress()
    {
        $arrTypeAddres = [
            ''  => '--Select an address type --',
            '1' => User::CASA,
            '2' => User::APARTAMENTO,
            '3' => User::SOBRADO,
            '4' => User::CHACARA,
            '5' => User::LOFT,

        ];

        return $arrTypeAddres;
    }

    private function setEncryptPassword( $password )
    {
        return bcrypt( trim( $password ) );
    }

    private function generateRemenberToken()
    {
        return str_random( 10 );
    }

    /**
     * @param $currentUrl
     * @return string
     */
    public function checksTheCurrentUrl( $currentUrl )
    {
        $urlTo = ( $currentUrl ) ? $currentUrl : route('users.index');

        return $urlTo;
    }

}
