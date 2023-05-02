<template>
    <div class="row" style="height: 85vh; padding: 20px;">
        <CometChatUserListWithMessages/>
        <button id="chat-logout" @click="logoutChat" hidden></button>
    </div>
</template>

<script>
import { CometChat } from "@cometchat-pro/chat";
import {CometChatUserListWithMessages} from './../CometChat-UI';

export default{
    components: {CometChatUserListWithMessages},
    onBeforeMount(){
        console.log("chat Mount");
    },  
    methods: {
        logoutChat(){
            CometChat.logout();
            console.log('logoutChat');
        },
    }
};



</script>