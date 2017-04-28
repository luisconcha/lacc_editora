module.exports = {
    init(){
        if ( window.Laravel.userId !== null ) {
            window.Echo.private('LaccUser.Models.User.' + window.Laravel.userId)
                .notification(notification => {
                    generateTemplateNotification(
                        'The book <strong>' + notification.book.title + '</strong> was exproted successfully',
                        'success',
                        7000
                    );
                });
        }
    }
};

function generateTemplateNotification( message, type, delay ) {
    window.$.notify(
        { message: message },
        {
            type   : type,
            delay  : delay,
            animate: {
                enter: 'animated lightSpeedIn',
                exit : 'animated lightSpeedOut'
            },
        });
}