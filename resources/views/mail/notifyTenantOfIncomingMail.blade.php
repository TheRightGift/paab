<!DOCTYPE html>
<p>Hi Dr. {{ $user->firstname}} {{ $user->lastname}}</p>
<p>This is to notify you of incoming email on your account with whitecoatdomain.com on your domain {{ $domain }}.</p>
<p><a href="https://{{$domain}}/mails">Click to access or view emails</a></p>
<p>Thank you</p>
