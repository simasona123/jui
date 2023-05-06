import {createApp} from 'vue';
import { CometChat } from "@cometchat-pro/chat";


import App from './components/App.vue';

var appID = "238389465943e705";
var region = "us";
var appSetting = new CometChat.AppSettingsBuilder().subscribePresenceForAllUsers().setRegion(region).build();

user['name'] = user['full_name'] + `(${user['role']})`;
user['email'] = 'user' + user['id'];

CometChat.init(appID, appSetting).then(
    async () => {
        console.log("Initialization completed successfully");
        console.log(user);
        await createUserOnCometChat(user['email'], user['name']);
        setTimeout(logUserInToCometChat(user['email']), 3000);
    },
    error => {
        console.log("Initialization failed with error:", error);
        // Check the reason for error and take appropriate action.
    }
);

async function logUserInToCometChat(UID) {
    const AUTH_KEY = "4e055e28326f19fc109b912601b22e3a22e44c08"
    console.log("logincometchat");
    CometChat.login(UID, AUTH_KEY).then(
        data => {
            console.log(data)
            createApp(App).mount("#app");
        },
        error => {
            this.showSpinner = false;
            alert("Whops. Something went wrong. This commonly happens when you enter a username that doesn't exist. Check the console for more information");
            console.log("Login failed with error:", error.code);
        }
    );
}

async function createUserOnCometChat(username, name) {
    const AUTH_KEY = "4e055e28326f19fc109b912601b22e3a22e44c08";
    const UID = username;
    console.log("createUserOnCOmet");
    var user = new CometChat.User(UID);
    user.setName(name);
    CometChat.createUser(user, AUTH_KEY).then(
        user => {
            console.log("user created", user);
        }, error => {
            console.log('error create user', error);
        }
    );
}

function logoutChat(){
    console.log('logout Chat');
    CometChat.logout();
}
