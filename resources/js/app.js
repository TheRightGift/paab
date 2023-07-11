/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { defineAsyncComponent } from "vue"

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});


// Async Loaded
app.component('home-component', defineAsyncComponent(() => import ('./components/HomeComponent.vue') ));
app.component('login-component', defineAsyncComponent(() => import ('./components/auth/LoginComponent.vue')));
app.component('resetpassword-component', defineAsyncComponent(() => import ('./components/auth/ResetPasswordComponent.vue')));
app.component('started-component', defineAsyncComponent(() => import('./components/auth/StartedComponent.vue')));
app.component('template-component', defineAsyncComponent(() => import('./components/TemplateComponent.vue')));

app.component('client-dashboard-component', defineAsyncComponent(() => import('./components/client/Dashboard.vue')));
app.component('client-websites-component', defineAsyncComponent(() => import('./components/client/WebsitesComponent.vue')));
app.component('client-settings-component', defineAsyncComponent(() => import('./components/client/Settings.vue')));
app.component('client-support-component', defineAsyncComponent(() => import('./components/client/SupportComponent.vue')));
app.component('client-singlemail-component', defineAsyncComponent(() => import('./components/client/SinglemailComponent.vue')));

app.component('sadmin-component', defineAsyncComponent(() => import('./components/super/Dashboard.vue')));
app.component('admins-component', defineAsyncComponent(() => import('./components/super/AdminsComponent.vue')));
app.component('sadmin-template-component', defineAsyncComponent(() => import('./components/super/Template.vue')));
app.component('sadmin-mail-component', defineAsyncComponent(() => import('./components/super/MailComponent.vue')));
app.component('sadmin-singlemail-component', defineAsyncComponent(() => import('./components/super/SinglemailComponent')));
app.component('sadmin-settings-component', defineAsyncComponent(() => import('./components/super/SettingsComponent')));
app.component('sadmin-client-component', defineAsyncComponent(() => import('./components/super/ClientComponent')));

app.component('admin-dashboard-component', defineAsyncComponent(() => import('./components/admin/Dashboard')));
app.component('admin-client-component', defineAsyncComponent(() => import('./components/admin/Client')));
app.component('temp-password-change-component', defineAsyncComponent(() => import('./components/shared/TempPasswordChange')));
app.component('admin-template-component', defineAsyncComponent(() => import('./components/admin/Template')));
app.component('admin-settings-component', defineAsyncComponent(() => import('./components/admin/Settings')));
// app.component('admin-singlemsg-component', defineAsyncComponent(() => import('./components/admin/SingleMsg')));
const templateProp = document.getElementById('app').getAttribute('data-template-prop');
let folderProp = document.getElementById('app').getAttribute('data-folder-prop');
const trimmed = folderProp.replace(/\s+/g, '');
app.component(`physician-${templateProp}-website-component`, defineAsyncComponent(() => import(`@/components/templates/Physicians/${trimmed}/MainTemplateComponent`)));
app.component(`physician-${templateProp}-website-setings`, defineAsyncComponent(() => import(`./components/templates/Physicians/${trimmed}/Settings/SettingsComponent`)));

// app.component('physician-2-website-component', defineAsyncComponent(() => import('./components/templates/Physicians/naturegreen/MainTemplateComponent')));
// app.component('physician-2-website-settings', defineAsyncComponent(() => import('./components/templates/Physicians/naturegreen/Settings/SettingsComponent')));

app.component('mail-component', defineAsyncComponent(() => import('./components/shared/Messages')));

// app.component("password-change-component", defineAsyncComponent(() => import('./components/templates/Physicians/Settings/tempSettings/PasswordChange.vue')));
// Developer
app.component("dev-signup-component", defineAsyncComponent(() => import('./components/developers/Signup.vue')));
app.component("developer-client-component", defineAsyncComponent(() => import('./components/shared/Developer.vue')));
app.component('dev-dashboard-component', defineAsyncComponent(() => import('./components/developers/Dashboard')));
app.component('dev-project-component', defineAsyncComponent(() => import('./components/developers/Project')));
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
