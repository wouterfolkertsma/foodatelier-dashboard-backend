export default class Messenger {
    constructor() {
        this.receiverId = '';
        this.senderId = '';
        this.pusher = new Pusher('870703b0ea4e1f8cea6b', {
            cluster: 'eu'
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        this.pusher.logToConsole = true;

        this.channel = this.pusher.subscribe('my-channel');
        this.bindChannel();

        this.users = document.getElementsByClassName('user');

        if (this.senderId) {
            this.senderId = this.senderId.getAttribute('data-id');
        }

        this.addMessageListener();

        if (this.users) {
            let self = this;
            [...this.users].forEach((user) => {
                user.addEventListener('click', (e) => {
                    this.receiverId = e.currentTarget.id;
                    e.currentTarget.classList.remove('active');
                    e.currentTarget.classList.add('active');

                    if (e.currentTarget.querySelector('.pending')) {
                        e.currentTarget.querySelector('.pending').remove();
                    }

                    $.ajax({
                        type:"get",
                        url: "messenger/" + this.receiverId,
                        data:"",
                        cache:false,
                        success: function (data){
                            $('#messages').html(data);
                            self.scrollToBottom();
                        }
                    });
                })
            });
        }
    }

    scrollToBottom() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }

    bindChannel() {
        let self = this;
        this.channel.bind('my-event', function(data) {
            this.senderId = $('meta[name="user-id"]').attr('content');
            if (this.senderId == data.from) { //Sender
                $('#' + data.to).click();//Refresh
            } else if (this.senderId == data.to) { //Receiver
                jsAlertInfoToast('received new message!')
                if (this.receiverId  == data.from) {
                    $('#' + data.from).click();//Refresh
                } else {
                    let pending = parseInt($('#' + data.from).find('.pending').html());
                    if (pending) {
                        $('#' + data.from).find('.pending').html(pending + 1)
                    } else {
                        $('#' + data.from).append('<span class="pending">1</span>')
                    }
                }
            }
        });
    }

    addMessageListener() {
        let self = this;
        $(document).on('keyup', '.input-text input', function(e) {
            let message = $(this).val();

            if(e.keyCode === 13 && message !== '' && this.receiverId !== '') {
                $(this).val('');
                
                let datastr = "receiver_id=" + self.receiverId + "&message=" + message;

                $.ajax({
                    type:"post",
                    url:"message",
                    data: datastr,
                    cache: false,
                    success: function (data){
                        $('#' + data.from).click();
                        self.scrollToBottom();
                    },
                    error: function (jqXHR, status, err){

                    },
                    complete:function (){

                    }
                })
            }
        });
    }
}



