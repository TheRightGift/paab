/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import HomeComponent from './components/HomeComponent.vue';
import StartedComponent from './components/auth/StartedComponent.vue';
import TemplateComponent from './components/TemplateComponent.vue';
import LoginComponent from './components/auth/LoginComponent.vue';
// import OtpComponent from './components/auth/OtpComponent.vue';
import ResetPasswordComponent from './components/auth/ResetPasswordComponent.vue';

// Client
import ClientComponent from './components/client/Dashboard.vue';
import ClientWebsitesComponent from './components/client/WebsitesComponent.vue';
// import ClientMailComponent from './components/client/MailComponent.vue';
import ClientSettings from './components/client/Settings.vue';
import ClientSupport from './components/client/SupportComponent.vue';
import ClientSingleMail from './components/client/SinglemailComponent.vue';


// Admin
import DashboardAdmin from './components/admin/Dashboard';
import TempPassChange from './components/shared/TempPasswordChange';
import ClientAdmin from "./components/admin/Client";
import TemplateAdmin from "./components/admin/Template";
// import MessagesAdmin from "./components/admin/Messages";
import SettingsAdmin from "./components/admin/Settings";
import SingleMsgAdmin from "./components/admin/SingleMsg";

// SAdmin
import DashboardSAdmin from './components/super/Dashboard';
import AdminComponent from './components/super/AdminsComponent';
import SadminTemplate from './components/super/Template';
// import SadminMail from "./components/super/MailComponent";
import SadminSingleMail from "./components/super/SinglemailComponent";
import SadminSettings from "./components/super/SettingsComponent";
import SadminClient from "./components/super/ClientComponent";


// Webiste
import PhysicianWebsiteComponent from './components/templates/Physicians/MainTemplateComponent';
import SettingsComponent from './components/templates/Physicians/Settings/SettingsComponent';

// Shared
import mails from './components/shared/Messages';

import Milestones from "./components/templates/Physicians/Settings/tempSettings/Milestones";
import SocialMedia from "./components/templates/Physicians/Settings/tempSettings/SocialMedia";
import ServicesRendered from "./components/templates/Physicians/Settings/tempSettings/ServicesRendered";
import PublicFeature from "./components/templates/Physicians/Settings/tempSettings/PublicFeature";
import PasswordChange from "./components/templates/Physicians/Settings/tempSettings/PasswordChange.vue";
import General from "./components/templates/Physicians/Settings/tempSettings/General";
import Bio from "./components/templates/Physicians/Settings/tempSettings/Bio";
import CVGenerator from "./components/templates/Physicians/Settings/tempSettings/CVGenerator.vue"

app.component('home-component', HomeComponent);
app.component('login-component', LoginComponent);
// app.component('otp-component', OtpComponent);
app.component('resetpassword-component', ResetPasswordComponent);
app.component('started-component', StartedComponent);
app.component('template-component', TemplateComponent);

app.component('client-dashboard-component', ClientComponent);
app.component('client-websites-component', ClientWebsitesComponent);

// app.component('client-mail-component', ClientMailComponent);
app.component('client-settings-component', ClientSettings);
app.component('client-support-component', ClientSupport);
app.component('client-singlemail-component', ClientSingleMail);

app.component('sadmin-component', DashboardSAdmin);
app.component('admins-component', AdminComponent);
app.component("sadmin-template-component", SadminTemplate);
// app.component("sadmin-mail-component", SadminMail);
app.component("sadmin-singlemail-component", SadminSingleMail);
app.component("sadmin-settings-component", SadminSettings);
app.component("sadmin-client-component", SadminClient);

app.component('admin-dashboard-component', DashboardAdmin);
app.component("admin-client-component", ClientAdmin);
app.component("admin-template-component", TemplateAdmin);
app.component("temp-password-change-component", TempPassChange);
app.component("admin-settings-component", SettingsAdmin);
app.component("admin-singlemsg-component", SingleMsgAdmin);

app.component('physician-website-component', PhysicianWebsiteComponent);
app.component('physician-website-settings', SettingsComponent);

app.component("mail-component", mails);

app.component("milestones-component", Milestones);
app.component("social-media-component", SocialMedia);
app.component("public-feature-component", PublicFeature);
app.component("password-change-component", PasswordChange);
app.component("general-component", General);
app.component("bio-component", Bio);
app.component("services-rendered-component", ServicesRendered);

app.component("cvgenerator-component", CVGenerator);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
