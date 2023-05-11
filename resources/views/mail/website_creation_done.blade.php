<!DOCTYPE html>
<html>
    <body>
    <h3>Dr {{ $detail['name'] }}</h3>
   
    <h5>Your website is now live!</h5>

    <!-- <p class="lead">
        To login into the backend of your website to make FURTHER changes or updates please use the link and password below. 
        When you login for the first time, you will be prompted to change your temporary password.
    </p> -->
    <p>Your website @ http://{{$detail['domain']}}.com is now live for viewing and you can follow the previous email instruction to login and continue making changes</p>
    <p class="lead">
        To login into the backend of your website to make FURTHER changes or updates please use the link and password below. 
        When you login for the first time, you will be prompted to change your temporary password.
    </p>

    <p>Happy surfing!</p>

    <p class="center">Temporary Password: {{ $detail['password'] }}</p>

    <a href="https://{{$detail['domain']}}.com/setting" target="_blank">https://{{$detail['domain']}}.com/setting</a>

    <p>Thank You</p>

    <p>White Coat Domain</p>
</body>
</html>


