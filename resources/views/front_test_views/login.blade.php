<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div>
        <h1>로그인 화면이당</h1>

        <form action="https://zz.msporthome.store/server/login" method = "POST">
            @csrf
            <input type='text' id="Email" name="Email" placeholder="Email"> </br>
            <input type='password' id="PW" name="PW" placeholder="PW">    </br>

            <input type='submit' value = "로그인 버튼">   

    </form>

    </div>


    
</body>
</html>