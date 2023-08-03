<template>
    <div>
        <ul
            id="sidenav-1"
            class="sidenav sidenav-fixed white d-flex align-center flex-col"
        >
            <nav
                class="customNavBar d-flex align-center flex-col justify-center mb-6"
            >
                <img
                    src="/media/img/wcd-logo-noBckg.webp"
                    class="responsive-img logo"
                />
            </nav>
            <template v-for="link in links" :key="link.id">
                <li
                    class="w-100 d-flex justify-center align-center mb-4"
                    :class="{ active: link.id === currentId }"
                    v-if="link.role === user.role || link.role == null"
                >
                    <a
                        :href="prefix + link.url"
                        class="d-flex justify-start align-center w-100"
                    >
                        <div
                            class="d-flex justify-start align-center w-100 gap-1 flexColumn"
                        >
                            <span v-html="link.icon" ref="svgIcon"></span>
                            <span
                                class="shrink-none"
                                :class="{ 'white-text': link.id === currentId }"
                                >{{ link.title }}</span
                            >
                        </div>
                    </a>
                </li>
            </template>
            <li class="w-100 d-flex justify-center align-center mb-4">
                <a
                    href="#logoutModal"
                    class="d-flex justify-start align-center modal-trigger w-100"
                >
                    <div
                        class="d-flex justify-start align-center gap-1 flexColumn w-100"
                    >
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M9.00195 7C9.01395 4.825 9.11095 3.647 9.87895 2.879C10.758 2 12.172 2 15 2H16C18.829 2 20.243 2 21.122 2.879C22 3.757 22 5.172 22 8V16C22 18.828 22 20.243 21.122 21.121C20.242 22 18.829 22 16 22H15C12.172 22 10.758 22 9.87895 21.121C9.11095 20.353 9.01395 19.175 9.00195 17"
                                stroke="#787486"
                                stroke-width="1.5"
                                stroke-linecap="round"
                            />
                            <path
                                d="M15 12H2M2 12L5.5 9M2 12L5.5 15"
                                stroke="#787486"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>

                        <span class="shrink-none">Logout</span>
                    </div>
                </a>
            </li>
            <div class="p-24 w-100 d-flex flex-col">
                <a
                    href="#!"
                    @click="toggleShrink"
                    id="toggleIcon"
                    class="align-self-end"
                >
                    <svg
                        width="26"
                        height="20"
                        viewBox="0 0 26 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M18.5004 17.2253C18.3421 17.2253 18.1837 17.1669 18.0587 17.0419L12.6254 11.6086C11.7421 10.7253 11.7421 9.27526 12.6254 8.39193L18.0587 2.95859C18.3004 2.71693 18.7004 2.71693 18.9421 2.95859C19.1837 3.20026 19.1837 3.60026 18.9421 3.84193L13.5087 9.27526C13.1087 9.67526 13.1087 10.3253 13.5087 10.7253L18.9421 16.1586C19.1837 16.4003 19.1837 16.8003 18.9421 17.0419C18.8171 17.1586 18.6587 17.2253 18.5004 17.2253Z"
                            fill="#787486"
                        />
                        <path
                            d="M12.5004 17.2253C12.3421 17.2253 12.1837 17.1669 12.0587 17.0419L6.62539 11.6086C5.74206 10.7253 5.74206 9.27526 6.62539 8.39193L12.0587 2.95859C12.3004 2.71693 12.7004 2.71693 12.9421 2.95859C13.1837 3.20026 13.1837 3.60026 12.9421 3.84193L7.50872 9.27526C7.10872 9.67526 7.10872 10.3253 7.50872 10.7253L12.9421 16.1586C13.1837 16.4003 13.1837 16.8003 12.9421 17.0419C12.8171 17.1586 12.6587 17.2253 12.5004 17.2253Z"
                            fill="#787486"
                        />
                    </svg>
                </a>
            </div>
        </ul>

        <div id="logoutModal" class="modal">
            <div class="modal-content">
                <div class="row logoutModalImageRow">
                    <img
                        src="/media/img/warning.png"
                        alt="Illustrating a warning that you will be logged out"
                        id="errAltImg"
                        class="logoutModalImage"
                    />
                </div>
                <div class="row center-align">
                    <p>You sure you want to logout from your space?</p>
                </div>

                <div class="row center-align">
                    <button
                        @click="logout"
                        class="primary waves-effect waves-green btn-flat"
                    >
                        Yes
                    </button>
                    <span class="gutter1"></span>
                    <button
                        class="modal-close primaryBorder waves-effect waves-green btn-flat"
                    >
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    ul {
        border-right: 1px solid rgba(158, 157, 157, 0.664);
        box-shadow: none;
    }
    .logo {
        width: 120px;
        height: 65px;
    }
    li > a {
        color: #787486;
        font-family: "Montserrat", sans-serif;
        font-size: 1rem;
        font-style: normal;
        font-weight: 500;
        line-height: 100%;
    }
    .active {
        height: 49px;
        background: #109dad !important;
    }
    .active a {
        font-weight: 600 !important;
    }
    .p-24 {
        padding: 24px;
    }
    .shrink .shrink-none {
        display: none;
    }
    .shrink .flexColumn {
        flex-direction: column;
    }
    .shrink .logo {
        width: 4vw;
        height: 5vh;
    }
</style>

<script>
    export default {
        name: "Sidenav",
        data() {
            return {
                currentId: 1,
                links: [
                    {
                        id: 1,
                        title: "Dashboard",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M7 10.75H5C2.58 10.75 1.25 9.42 1.25 7V5C1.25 2.58 2.58 1.25 5 1.25H7C9.42 1.25 10.75 2.58 10.75 5V7C10.75 9.42 9.42 10.75 7 10.75ZM5 2.75C3.42 2.75 2.75 3.42 2.75 5V7C2.75 8.58 3.42 9.25 5 9.25H7C8.58 9.25 9.25 8.58 9.25 7V5C9.25 3.42 8.58 2.75 7 2.75H5Z" fill="#787486"/>
                                                        <path d="M19 10.75H17C14.58 10.75 13.25 9.42 13.25 7V5C13.25 2.58 14.58 1.25 17 1.25H19C21.42 1.25 22.75 2.58 22.75 5V7C22.75 9.42 21.42 10.75 19 10.75ZM17 2.75C15.42 2.75 14.75 3.42 14.75 5V7C14.75 8.58 15.42 9.25 17 9.25H19C20.58 9.25 21.25 8.58 21.25 7V5C21.25 3.42 20.58 2.75 19 2.75H17Z" fill="#787486"/>
                                                        <path d="M19 22.75H17C14.58 22.75 13.25 21.42 13.25 19V17C13.25 14.58 14.58 13.25 17 13.25H19C21.42 13.25 22.75 14.58 22.75 17V19C22.75 21.42 21.42 22.75 19 22.75ZM17 14.75C15.42 14.75 14.75 15.42 14.75 17V19C14.75 20.58 15.42 21.25 17 21.25H19C20.58 21.25 21.25 20.58 21.25 19V17C21.25 15.42 20.58 14.75 19 14.75H17Z" fill="#787486"/>
                                                        <path d="M7 22.75H5C2.58 22.75 1.25 21.42 1.25 19V17C1.25 14.58 2.58 13.25 5 13.25H7C9.42 13.25 10.75 14.58 10.75 17V19C10.75 21.42 9.42 22.75 7 22.75ZM5 14.75C3.42 14.75 2.75 15.42 2.75 17V19C2.75 20.58 3.42 21.25 5 21.25H7C8.58 21.25 9.25 20.58 9.25 19V17C9.25 15.42 8.58 14.75 7 14.75H5Z" fill="#787486"/>
                                                    </svg>`,
                        url: "/dashboard",
                        role: null,
                    },
                    {
                        id: 2,
                        title: "Websites",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.36 12C14.44 11.34 14.5 10.68 14.5 10C14.5 9.32 14.44 8.66 14.36 8H17.74C17.9 8.64 18 9.31 18 10C18 10.69 17.9 11.36 17.74 12M12.59 17.56C13.19 16.45 13.65 15.25 13.97 14H16.92C15.9512 15.6683 14.4141 16.932 12.59 17.56ZM12.34 12H7.66C7.56 11.34 7.5 10.68 7.5 10C7.5 9.32 7.56 8.65 7.66 8H12.34C12.43 8.65 12.5 9.32 12.5 10C12.5 10.68 12.43 11.34 12.34 12ZM10 17.96C9.17 16.76 8.5 15.43 8.09 14H11.91C11.5 15.43 10.83 16.76 10 17.96ZM6 6H3.08C4.03886 4.32721 5.5748 3.06149 7.4 2.44C6.8 3.55 6.35 4.75 6 6ZM3.08 14H6C6.35 15.25 6.8 16.45 7.4 17.56C5.57862 16.9317 4.04485 15.6677 3.08 14ZM2.26 12C2.1 11.36 2 10.69 2 10C2 9.31 2.1 8.64 2.26 8H5.64C5.56 8.66 5.5 9.32 5.5 10C5.5 10.68 5.56 11.34 5.64 12M10 2.03C10.83 3.23 11.5 4.57 11.91 6H8.09C8.5 4.57 9.17 3.23 10 2.03ZM16.92 6H13.97C13.657 4.76146 13.1936 3.5659 12.59 2.44C14.43 3.07 15.96 4.34 16.92 6ZM10 0C4.47 0 0 4.5 0 10C0 12.6522 1.05357 15.1957 2.92893 17.0711C3.85752 17.9997 4.95991 18.7362 6.17317 19.2388C7.38642 19.7413 8.68678 20 10 20C12.6522 20 15.1957 18.9464 17.0711 17.0711C18.9464 15.1957 20 12.6522 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7362 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0Z" fill="#787486"/>
                                                </svg>
                                            `,
                        url: "/websites",
                        role: "Client",
                    },
                    {
                        id: 3,
                        title: "Staff",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.16055 10.87C9.06055 10.86 8.94055 10.86 8.83055 10.87C6.45055 10.79 4.56055 8.84 4.56055 6.44C4.56055 3.99 6.54055 2 9.00055 2C11.4505 2 13.4405 3.99 13.4405 6.44C13.4305 8.84 11.5405 10.79 9.16055 10.87Z" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M16.4093 4C18.3493 4 19.9093 5.57 19.9093 7.5C19.9093 9.39 18.4093 10.93 16.5393 11C16.4593 10.99 16.3693 10.99 16.2793 11" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M4.1607 14.56C1.7407 16.18 1.7407 18.82 4.1607 20.43C6.9107 22.27 11.4207 22.27 14.1707 20.43C16.5907 18.81 16.5907 16.17 14.1707 14.56C11.4307 12.73 6.9207 12.73 4.1607 14.56Z" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M18.3398 20C19.0598 19.85 19.7398 19.56 20.2998 19.13C21.8598 17.96 21.8598 16.03 20.2998 14.86C19.7498 14.44 19.0798 14.16 18.3698 14" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            `,
                        url: "/admins",
                        role: "SuperAdmin",
                    },
                    {
                        id: 4,
                        title: "Clients",
                        icon: `<svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.9992 12.7148C15.6811 12.7148 16.3352 12.9858 16.8174 13.468C17.2997 13.9502 17.5706 14.6043 17.5706 15.2863V15.8991C17.5706 18.9651 13.962 21.2863 8.99916 21.2863C4.03631 21.2863 0.427734 19.086 0.427734 15.8991V15.2863C0.427734 14.6043 0.698652 13.9502 1.18089 13.468C1.66312 12.9858 2.31718 12.7148 2.99916 12.7148H14.9992ZM14.9992 14.0006H2.99916C2.67968 14.0006 2.37165 14.1195 2.13507 14.3342C1.8985 14.5489 1.75033 14.844 1.71945 15.162L1.71345 15.2863V15.8991C1.71345 18.1911 4.61831 20.0006 8.99916 20.0006C13.2214 20.0006 16.1606 18.1963 16.2806 16.0371L16.2849 15.8991V15.2863C16.2849 14.9668 16.1659 14.6588 15.9512 14.4222C15.7365 14.1856 15.4414 14.0374 15.1234 14.0066L14.9992 14.0006ZM8.99916 0.714844C9.67453 0.714844 10.3433 0.847868 10.9672 1.10632C11.5912 1.36477 12.1582 1.74359 12.6357 2.22115C13.1133 2.69871 13.4921 3.26565 13.7505 3.88961C14.009 4.51357 14.142 5.18233 14.142 5.8577C14.142 6.53307 14.009 7.20183 13.7505 7.82579C13.4921 8.44975 13.1133 9.01669 12.6357 9.49425C12.1582 9.97181 11.5912 10.3506 10.9672 10.6091C10.3433 10.8675 9.67453 11.0006 8.99916 11.0006C7.63519 11.0006 6.32709 10.4587 5.36261 9.49425C4.39814 8.52978 3.85631 7.22167 3.85631 5.8577C3.85631 4.49373 4.39814 3.18562 5.36261 2.22115C6.32709 1.25668 7.63519 0.714844 8.99916 0.714844ZM8.99916 2.00056C7.97618 2.00056 6.99511 2.40693 6.27175 3.13029C5.5484 3.85364 5.14202 4.83472 5.14202 5.8577C5.14202 6.88068 5.5484 7.86176 6.27175 8.58511C6.99511 9.30847 7.97618 9.71484 8.99916 9.71484C10.0221 9.71484 11.0032 9.30847 11.7266 8.58511C12.4499 7.86176 12.8563 6.88068 12.8563 5.8577C12.8563 4.83472 12.4499 3.85364 11.7266 3.13029C11.0032 2.40693 10.0221 2.00056 8.99916 2.00056Z" fill="#787486"/>
                                                </svg>
                                            `,
                        url: "/client",
                        role: "Admin" || "SuperAdmin",
                    },
                    {
                        id: 5,
                        title: "Clients",
                        icon: `<svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.9992 12.7148C15.6811 12.7148 16.3352 12.9858 16.8174 13.468C17.2997 13.9502 17.5706 14.6043 17.5706 15.2863V15.8991C17.5706 18.9651 13.962 21.2863 8.99916 21.2863C4.03631 21.2863 0.427734 19.086 0.427734 15.8991V15.2863C0.427734 14.6043 0.698652 13.9502 1.18089 13.468C1.66312 12.9858 2.31718 12.7148 2.99916 12.7148H14.9992ZM14.9992 14.0006H2.99916C2.67968 14.0006 2.37165 14.1195 2.13507 14.3342C1.8985 14.5489 1.75033 14.844 1.71945 15.162L1.71345 15.2863V15.8991C1.71345 18.1911 4.61831 20.0006 8.99916 20.0006C13.2214 20.0006 16.1606 18.1963 16.2806 16.0371L16.2849 15.8991V15.2863C16.2849 14.9668 16.1659 14.6588 15.9512 14.4222C15.7365 14.1856 15.4414 14.0374 15.1234 14.0066L14.9992 14.0006ZM8.99916 0.714844C9.67453 0.714844 10.3433 0.847868 10.9672 1.10632C11.5912 1.36477 12.1582 1.74359 12.6357 2.22115C13.1133 2.69871 13.4921 3.26565 13.7505 3.88961C14.009 4.51357 14.142 5.18233 14.142 5.8577C14.142 6.53307 14.009 7.20183 13.7505 7.82579C13.4921 8.44975 13.1133 9.01669 12.6357 9.49425C12.1582 9.97181 11.5912 10.3506 10.9672 10.6091C10.3433 10.8675 9.67453 11.0006 8.99916 11.0006C7.63519 11.0006 6.32709 10.4587 5.36261 9.49425C4.39814 8.52978 3.85631 7.22167 3.85631 5.8577C3.85631 4.49373 4.39814 3.18562 5.36261 2.22115C6.32709 1.25668 7.63519 0.714844 8.99916 0.714844ZM8.99916 2.00056C7.97618 2.00056 6.99511 2.40693 6.27175 3.13029C5.5484 3.85364 5.14202 4.83472 5.14202 5.8577C5.14202 6.88068 5.5484 7.86176 6.27175 8.58511C6.99511 9.30847 7.97618 9.71484 8.99916 9.71484C10.0221 9.71484 11.0032 9.30847 11.7266 8.58511C12.4499 7.86176 12.8563 6.88068 12.8563 5.8577C12.8563 4.83472 12.4499 3.85364 11.7266 3.13029C11.0032 2.40693 10.0221 2.00056 8.99916 2.00056Z" fill="#787486"/>
                                                </svg>
                                            `,
                        url: "/client",
                        role: "SuperAdmin",
                    },
                    {
                        id: 6,
                        title: "Templates",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.3691 8.88086H17.6191" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M6.38086 8.88086L7.13086 9.63086L9.38086 7.38086" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.3691 15.8809H17.6191" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M6.38086 15.8809L7.13086 16.6309L9.38086 14.3809" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            `,
                        url: "/template",
                        role: "SuperAdmin",
                    },
                    {
                        id: 7,
                        title: "Templates",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.3691 8.88086H17.6191" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M6.38086 8.88086L7.13086 9.63086L9.38086 7.38086" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.3691 15.8809H17.6191" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M6.38086 15.8809L7.13086 16.6309L9.38086 14.3809" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#787486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            `,
                        url: "/template",
                        role: "Admin",
                    },
                    {
                        id: 8,
                        title: "Mails",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18.6004 4.80078C19.396 4.80078 20.1591 5.11685 20.7217 5.67946C21.2843 6.24207 21.6004 7.00513 21.6004 7.80078V17.4008C21.6004 18.1964 21.2843 18.9595 20.7217 19.5221C20.1591 20.0847 19.396 20.4008 18.6004 20.4008H5.40039C4.60474 20.4008 3.84168 20.0847 3.27907 19.5221C2.71646 18.9595 2.40039 18.1964 2.40039 17.4008V7.80078C2.40039 7.00513 2.71646 6.24207 3.27907 5.67946C3.84168 5.11685 4.60474 4.80078 5.40039 4.80078H18.6004ZM20.4004 9.55398L12.3052 14.318C12.2287 14.3629 12.1431 14.3903 12.0547 14.3982C11.9663 14.4061 11.8773 14.3943 11.794 14.3636L11.6956 14.318L3.60039 9.55638V17.4008C3.60039 17.8782 3.79003 18.336 4.1276 18.6736C4.46516 19.0111 4.923 19.2008 5.40039 19.2008H18.6004C19.0778 19.2008 19.5356 19.0111 19.8732 18.6736C20.2107 18.336 20.4004 17.8782 20.4004 17.4008V9.55398ZM18.6004 6.00078H5.40039C4.923 6.00078 4.46516 6.19042 4.1276 6.52799C3.79003 6.86555 3.60039 7.32339 3.60039 7.80078V8.16318L12.0004 13.1048L20.4004 8.16078V7.80078C20.4004 7.32339 20.2107 6.86555 19.8732 6.52799C19.5356 6.19042 19.0778 6.00078 18.6004 6.00078Z" fill="#787486"/>
                                                </svg>
                                            `,
                        url: "/mail",
                        role: null,
                    },
                    {
                        id: 9,
                        title: "Settings",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#787486" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 12.8794V11.1194C2 10.0794 2.85 9.21945 3.9 9.21945C5.71 9.21945 6.45 7.93945 5.54 6.36945C5.02 5.46945 5.33 4.29945 6.24 3.77945L7.97 2.78945C8.76 2.31945 9.78 2.59945 10.25 3.38945L10.36 3.57945C11.26 5.14945 12.74 5.14945 13.65 3.57945L13.76 3.38945C14.23 2.59945 15.25 2.31945 16.04 2.78945L17.77 3.77945C18.68 4.29945 18.99 5.46945 18.47 6.36945C17.56 7.93945 18.3 9.21945 20.11 9.21945C21.15 9.21945 22.01 10.0694 22.01 11.1194V12.8794C22.01 13.9194 21.16 14.7794 20.11 14.7794C18.3 14.7794 17.56 16.0594 18.47 17.6294C18.99 18.5394 18.68 19.6994 17.77 20.2194L16.04 21.2094C15.25 21.6794 14.23 21.3994 13.76 20.6094L13.65 20.4194C12.75 18.8494 11.27 18.8494 10.36 20.4194L10.25 20.6094C9.78 21.3994 8.76 21.6794 7.97 21.2094L6.24 20.2194C5.33 19.6994 5.02 18.5294 5.54 17.6294C6.45 16.0594 5.71 14.7794 3.9 14.7794C2.85 14.7794 2 13.9194 2 12.8794Z" stroke="#787486" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            `,
                        url: "/settings",
                        role: "Client",
                    },
                    {
                        id: 10,
                        title: "Settings",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#787486" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 12.8794V11.1194C2 10.0794 2.85 9.21945 3.9 9.21945C5.71 9.21945 6.45 7.93945 5.54 6.36945C5.02 5.46945 5.33 4.29945 6.24 3.77945L7.97 2.78945C8.76 2.31945 9.78 2.59945 10.25 3.38945L10.36 3.57945C11.26 5.14945 12.74 5.14945 13.65 3.57945L13.76 3.38945C14.23 2.59945 15.25 2.31945 16.04 2.78945L17.77 3.77945C18.68 4.29945 18.99 5.46945 18.47 6.36945C17.56 7.93945 18.3 9.21945 20.11 9.21945C21.15 9.21945 22.01 10.0694 22.01 11.1194V12.8794C22.01 13.9194 21.16 14.7794 20.11 14.7794C18.3 14.7794 17.56 16.0594 18.47 17.6294C18.99 18.5394 18.68 19.6994 17.77 20.2194L16.04 21.2094C15.25 21.6794 14.23 21.3994 13.76 20.6094L13.65 20.4194C12.75 18.8494 11.27 18.8494 10.36 20.4194L10.25 20.6094C9.78 21.3994 8.76 21.6794 7.97 21.2094L6.24 20.2194C5.33 19.6994 5.02 18.5294 5.54 17.6294C6.45 16.0594 5.71 14.7794 3.9 14.7794C2.85 14.7794 2 13.9194 2 12.8794Z" stroke="#787486" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            `,
                        url: "/settings",
                        role: "Admin",
                    },
                    {
                        id: 11,
                        title: "Help/Support",
                        icon: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_1843_3456)">
                                                    <path d="M12.0003 23.1431C18.1543 23.1431 23.1431 18.1543 23.1431 12.0003C23.1431 5.84625 18.1543 0.857422 12.0003 0.857422C5.84625 0.857422 0.857422 5.84625 0.857422 12.0003C0.857422 18.1543 5.84625 23.1431 12.0003 23.1431Z" stroke="#787486" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9.42773 9.42885C9.42773 8.92027 9.57855 8.42311 9.8611 8.00024C10.1437 7.57737 10.5453 7.24779 11.0151 7.05316C11.485 6.85854 12.002 6.80761 12.5008 6.90683C12.9996 7.00605 13.4578 7.25096 13.8174 7.61058C14.1771 7.9702 14.422 8.42838 14.5212 8.92719C14.6204 9.426 14.5695 9.94303 14.3749 10.4129C14.1802 10.8828 13.8506 11.2844 13.4278 11.5669C13.0049 11.8495 12.5077 12.0003 11.9992 12.0003V13.7146" stroke="#787486" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12.0006 16.2852C11.7463 16.2852 11.4977 16.3606 11.2863 16.5018C11.0748 16.6431 10.91 16.8439 10.8127 17.0788C10.7154 17.3138 10.6899 17.5723 10.7395 17.8217C10.7892 18.0711 10.9116 18.3002 11.0914 18.48C11.2712 18.6598 11.5003 18.7823 11.7497 18.8319C11.9991 18.8815 12.2576 18.856 12.4926 18.7587C12.7275 18.6614 12.9283 18.4966 13.0696 18.2852C13.2109 18.0737 13.2863 17.8252 13.2863 17.5709C13.2818 17.2313 13.1449 16.9068 12.9048 16.6666C12.6646 16.4265 12.3402 16.2896 12.0006 16.2852Z" fill="#787486"/>
                                                    </g>
                                                    <defs>
                                                    <clipPath id="clip0_1843_3456">
                                                    <rect width="24" height="24" fill="white"/>
                                                    </clipPath>
                                                    </defs>
                                                    </svg>
                                            `,
                        url: "/support",
                        role: "Client",
                    },
                    {
                        id: 12,
                        title: "Developers",
                        icon: "laptop_windows",
                        url: "/developers",
                        role: "Admin",
                    },
                    {
                        id: 13,
                        title: "Developers",
                        icon: "laptop_windows",
                        url: "/developers",
                        role: "SuperAdmin",
                    },
                    {
                        id: 14,
                        title: "Projects",
                        icon: "work",
                        url: "/projects",
                        role: "Developer",
                    },
                ],
                prefix: "/client",
                shown: false,
                user: {},
            };
        },
        methods: {
            checkInitialPassUsing() {
                axios
                    .get("/api/check_password")
                    .then((res) => {
                        if (res.data.status == 401) {
                            let url = "/admin/password-change";
                            location.pathname != url ? location.replace(url) : null;
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            getLocation() {
                let location = window.location.pathname.split("/")[2];
                let linkId = this.links.find((el) => el.url === `/${location}`);
                this.currentId = linkId != undefined ? linkId.id : 1;
                setTimeout(() => {
                    this.updateSVGColor();
                }, 300);
            },
            deleteCookie(name, path, domain) {
                if (this.getCookie(name)) {
                    document.cookie =
                        name +
                        "=" +
                        (path ? ";path=" + path : "") +
                        // (domain ? ";domain=" + domain : "") +
                        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
                }
            },
            getCookie(name) {
                return document.cookie.split(";").some((c) => {
                    return c.trim().startsWith(name + "=");
                });
            },
            getUser() {
                axios
                    .get("/api/user")
                    .then((res) => {
                        this.user = res.data;
                        this.$emit("user", res.data);
                        if (res.data.role == "Admin") {
                            this.checkInitialPassUsing();
                            this.prefix = "/admin";
                        } else if (res.data.role == "Client") {
                            this.prefix = "/client";
                        } else if (res.data.role == "SuperAdmin") {
                            this.prefix = "/supre";
                        } else if (res.data.role == "Developer") {
                            this.prefix = "/developers";
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            logout() {
                axios
                    .post("/auth/logout")
                    .then((res) => {
                        if (res.data.status == 401) {
                            this.deleteCookie("_token", "/");
                            location.replace("/");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            toggleShrink() {
                const sidenav = document.querySelector(".sidenav");
                sidenav.classList.toggle("shrink");
                const headerElement = document.querySelector("header");
                const mainElement = document.querySelector("main");
                const toggler = document.getElementById("toggleIcon");
                // const footerElement = document.querySelector('footer');
                document.querySelector('body').classList.toggle('shrinkedSideNav');
                if (sidenav.classList.contains("shrink")) {
                    toggler.style.transform = "rotate(180deg)";
                } else {
                    toggler.style.transform = "rotate(360deg)";
                }
            },
            updateSVGColor() {
                const item = document.querySelector("li.active a svg");
                if (item) {
                    const paths = item.getElementsByTagName("path");
                    for (const path of paths) {
                        path.setAttribute("fill", "white");
                    }
                }
            },
        },
        mounted() {
            this.getUser();
            this.getLocation();
        },
    };
</script>