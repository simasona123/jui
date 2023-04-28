<div class="chat-position w-5rem">
    <button type="button" id="toggle-chat" class="btn btn-primary"><i class="far fa-comments" style="margin-right: 4px;"></i>Konsultasi</button>
    <div class="container-chat">
        <div class="panel panel-default" id="chat" style="display: none">
            <div class="" 
                x-data="{
                    full_name:'{{Auth::user()->full_name}}',
                    messages: [],
                    message: '',
                    image: document.querySelector('#image'),
                    async postMessage(){
                        if(this.message == ''){return}
                        let x = this;
                        let lengthMessage = this.messages.length;
                        let parentMessageId = lengthMessage == 0 ? '' : this.messages[lengthMessage-1]['id'];
                        let body = {
                            'subject': x.message,
                            'creator_id': '{{Auth::user()->id}}',
                            'parent_message_id': parentMessageId,
                            'created_at': x.getTimestamp(),
                            'full_name': x.full_name,
                        }
                        if (x.image.files[0] != null){
                            body['image'] = x.image.files[0];
                        }
                        let resp = await axios.post('/messages', body, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            },
                        });
                        this.message = '';
                        x.image.value = '';
                    },
                    getTimestamp(){
                        $now = new Date();
                        return `${$now.getFullYear()}-${$now.getMonth()}-${$now.getDate()} ${$now.getHours()}:${$now.getMinutes()}:${$now.getSeconds()}`;
                    },
                    fetchMessages() {
                        let x = this;
                        axios.get('/messages').then(response => {
                            console.log(response.data)
                            x.messages = response.data;
                        });
                    },
                }" @chatreceived.window="
                        messages.push($event.detail.e.message)
                        console.log(messages)
                    " 
                x-init="
                    fetchMessages();
                "
                >
                <div class="panel-body">
                    <ul class="chat">
                        <template x-for='(message, index) in messages'>
                            <li class="clearfix">
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font" x-text="message['user']['full_name']">
                                        </strong>
                                    </div>
                                    <img class="images-chat" x-show="(message['image'] ?? false) && message['image']!='0'" :src="message['image'] != '0' ? `storage/${message['image']}`:''" alt="">
                                    <p x-text="message['subject']">  
                                    </p>
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>

                <div class="panel-footer">
                    <div class="input-group">
                        <input type="text" x-model="message" class="form-control input-sm" placeholder="Type your message here...">
                        <label class="image-icon" for="image"><i class="far fa-file-image fa-lg"></i></label>
                        <input type="file" id="image" accept="image/png, image/jpeg" hidden>
                            <button class="btn btn-primary btn-sm" id="btn-chat" @click="postMessage">
                                Kirim
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
    let chatContainer = document.querySelector('.chat-position');
    let toggleChatStatus = false;
    let toggleChat = document.querySelector('#toggle-chat');
    let chat = document.querySelector('#chat');
    toggleChat.onclick = ()=>{
        if(!toggleChatStatus){
            chatContainer.classList.remove('w-5rem');
            chatContainer.classList.add('w-20rem');
        }else{
            chatContainer.classList.remove('w-20rem');
            chatContainer.classList.add('w-5rem');
        }
        toggleChatStatus = !toggleChatStatus;
        chat.style.display = chat.style.display == 'none' ? 'block' : 'none';
    };
    let userId = {{Auth::user()->id}};
    window.Echo.channel('coba.chat')
        .listen('MessageSent', (e) => {
            console.log(window.dispatchEvent(new CustomEvent('chatreceived', {
                'detail': {e},
            })));
        })
</script>



<style>
    .chat-position{
        position: absolute;
        bottom: 4rem;
        right: 1rem;
    }
    .images-chat{
        width: 90%;
        height: 100%;
        object-fit: cover;
    }
    .w-5rem{
        width: 8rem;
    }
    .w-20rem{
        width: 20rem;
    }
    #toggle-chat{
        width: 100%;
    }
    .container-chat{
        width: 100%;
    }
    .image-icon{
        position: absolute;
        top: .5rem;
        right: 3.8rem;
    }
    .chat {
      list-style: none;
      margin: 0;
      padding: 0;
    }
  
    .chat li {
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 1px dotted #B3A9A9;
    }
  
    .chat li .chat-body p {
      margin: 0;
      color: #777777;
    }
  
    .panel-body {
      overflow-y: scroll;
      height: 350px;
    }
  
    ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
      background-color: #F5F5F5;
    }
  
    ::-webkit-scrollbar {
      width: 12px;
      background-color: #F5F5F5;
    }
  
    ::-webkit-scrollbar-thumb {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
      background-color: #555;
    }
    .right{
        text-align: right;
        margin-right: 5px;
    }
  </style>
  