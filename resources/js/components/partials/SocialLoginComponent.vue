<template>
    <div>
        <div class="row loginSocialMedDiv">
            <div class="col l12 m12 s12 loginSocialMedInnerDiv">
                <p class="loginSocialMedTxt">or login with</p>

                <div class="socialMedIconsDiv">
                    <a href="/auth/login/linkedin">
                        <i
                            class="fa-brands fa-square-instagram socialMedIcons"
                        ></i>
                    </a>
                    <a href="/auth/login/facebook">
                        <i class="fa-brands fa-facebook socialMedIcons"></i>
                    </a>
                    <a href="/auth/login/twitter">
                        <i class="fa-brands fa-twitter socialMedIcons"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "SocialLogin"
}
</script>