<!DOCTYPE html>
<html>
    <body>
    <h3>Dr {{ $detail['name'] }}</h3>
   
    <h5>Your website created!</h5>

    <!-- <p class="lead">
        To login into the backend of your website to make FURTHER changes or updates please use the link and password below. 
        When you login for the first time, you will be prompted to change your temporary password.
    </p> -->
    <p>Your website @http://{{$detail['domain']}} is pending creation, and will be ready in 10mins, we'll notify you in when it is ready. In the meantime, you can make changes, by following the instructions below</p>
    <p class="lead">
        To login into the backend of your website to make FURTHER changes or updates please use the link and password below. 
        When you login for the first time, you will be prompted to change your temporary password.
    </p>

    <p>Happy surfing!</p>

    <p class="center">Temporary Password: {{ $detail['password'] }}</p>

    <a href="https://{{str_replace('.com', '', $detail['domain'])}}.whitecoatdomain.com/setting" target="_blank">https://{{str_replace('.com', '', $detail['domain'])}}.whitecoatdomain.com/setting</a>

    <p>Thank You</p>

    <p>White Coat Domain</p>
</body>
</html>


