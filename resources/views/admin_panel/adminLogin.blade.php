<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
    
label.error {
  color: #a94442;
  background-color: #f2dede;
  
}
.text-danger {
    color: #ff0000;
}
</style>
<body>
    <div class="login-page" id="loginApp">
        <div class="form" >
            <h3>Freshgo Admin</h3>
            <h5 class="text-danger" v-if="login_error != '' "> @{{login_error}}</h5>
                <input type="text" name="Username" id="Username" placeholder="username" v-model="username"/>
                <input type="password" name="Password" id="Password" placeholder="password" v-model="password" />
                <input type="submit" name="loginButton" id="loginButton" value="LOGIN" @click="login()"/>
        </div>
    </div>
</body>
</html>
<script src="{{asset('js/app.js')}}"></script>

<!--JQUERY Validation-->
<script>
	const app = new Vue({
      el: '#loginApp',
      data(){
        return{
          username : '',
          password : '',
          login_error : '',
        }
      },
      mounted(){
        console.log('mounted')
      },
      methods : {
        login(){
          axios.post("/admin/login", {
                    username: this.username,
                    password: this.password,
                })
                .then(response => {
                    if (response.data.message == "success") {
                        location.href = "http://localhost:8000/admin_panel?token="+response.data.token;
                    } else{
                      this.login_error = 'Username or password is incorrect';
                    }
                })
                .catch(error => {
                  this.login_error = 'Username or password is incorrect';
                });
        }
      }
  });


	</script>
<!--/JQUERY Validation-->
