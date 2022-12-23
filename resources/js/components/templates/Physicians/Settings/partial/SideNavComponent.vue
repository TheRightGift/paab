<template>
    <div>
        <div class="editWebSidenavDiv">
            <div class="editWebSidenavProImgDiv"></div>

            <div class="editWebSidenavDomainNameDiv">
                <a href="#" class="editWebSidenavDomainNameLink">{{ host }}</a>

                <a href="#!" @click="openNew">
                    <i class="material-icons editWebSidenavTempIcon"
                        >open_in_new</i
                    >
                </a>
            </div>

            <div class="editWebSidenavDomainNameDiv">
                <span class="editWebSidenavDomainNameLink">{{ date }}</span>

                <i class="material-icons editWebSidenavTempIcon">date_range</i>
            </div>

            <div class="editWebSidenavDomainNameDiv">
                <a href="#!" class="editWebSidenavDomainNameLink">
                    My Settings
                    <i class="material-icons editWebSidenavTempIcon"
                        >dashboard</i
                    >
                </a>
            </div>
            <div class="editWebSidenavDomainNameDiv">
                <a href="#!" class="editWebSidenavDomainNameLink" @click="openPromotionals">
                    Add Promotionals
                    <i class="material-icons editWebSidenavTempIcon"
                        >close</i
                    >
                </a>
            </div>

            <div>
                <img
                    src="/media/img/settings.png"
                    alt="fillForm.png"
                    class="editWebSidenavImg"
                />
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                date: new Date().toLocaleDateString("en-us", {
                    weekday: "long",
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                }),
                host: location.host,
            };
        },
        methods: {
            openNew() {
                window.open(`http://${this.host}`, "_blank");
            },
            openPromotionals() {
                this.$emit('openPromotionals');
            }
        },
    };
</script>