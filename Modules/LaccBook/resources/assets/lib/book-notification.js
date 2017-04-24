module.exports = {
    init(){
        if ( window.Laravel.userId !== null ) {
            window.Echo.private('LaccUser.Models.User.' + window.Laravel.userId)
                .notification(notification => {
                  console.log('Obj: ', notification);
            });
        }
    }
}