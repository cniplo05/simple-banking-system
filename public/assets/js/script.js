

const app = new Vue({
    el : '#app',

    data:{
        user :[],
        input_id : '',
        input_username : '',
        input_pin : '',
        cookie_userid : '',
        input_amount : 0,
        cardwindow : 0,
        signup : false,
        login : true
    },
    created(){
        if(this.getCookie("userid") != null){
            this.getUser();
            this.login = false;
            this.cardwindow = 1;
        }
    },
    methods: {
        getCookie(name) {
            var dc = document.cookie;
            var prefix = name + "=";
            var begin = dc.indexOf("; " + prefix);
            if (begin == -1) {
                begin = dc.indexOf(prefix);
                if (begin != 0) return null;
            }
            else
            {
                begin += 2;
                var end = document.cookie.indexOf(";", begin);
                if (end == -1) {
                end = dc.length;
                }
            }
            // because unescape has been deprecated, replaced with decodeURI
            //return unescape(dc.substring(begin + prefix.length, end));
            return decodeURI(dc.substring(begin + prefix.length, end));
        }, 
        switchForm(input){
            if(input == 1){ 
                this.signup = true;
                this.login = false;
            }else{
                this.login = true;
                this.signup = false;
            }
        },
        trySignUp(){
            var formData = new FormData();
            formData.append('id',this.input_id);
            formData.append('pin',this.input_pin);
            formData.append('username',this.input_username);
            axios.post('signup',formData).then( response =>{
                this.input_id = '';
                this.input_username = '';
                this.input_pin = '';
            });
        },
        tryLogin(){
            var formData = new FormData();
            formData.append('id',this.input_id);
            formData.append('pin',this.input_pin);
            axios.post('login',formData).then( response =>{
                let user = response.data;
                this.user = user;
                if( typeof(user) != 'string'){
                    this.getUser();
                    swal("Login Successful", "Congrats", "success");
                    this.input_id = '';
                    this.input_pin = '';
                    this.login = false;
                    this.cardwindow = 1;
                }else {
                    swal({
                        title: "Invalid User",
                        text: "Try again?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      }).then((willDelete) => {
                        this.input_id = '';
                        this.input_pin = '';
                      });
                }
            });
        },
        tryLogout(){
            axios.get('logout').then( response =>{
                console.log(response.data);
                this.user = [];
                this.login = true;
            })
        },
        switchToCard(id){
            this.cardwindow = id;
            this.getUser();
        },
        withdraw(){
            if(parseFloat(this.input_amount) <= this.user[3]){
                var formData = new FormData();
                formData.append('id',this.user[0]);
                formData.append('input_amount',parseFloat(this.input_amount));
                axios.post('withdraw',formData).then( response =>{
                    swal("Withdrawal Successful", "Congrats", "success");
                })
                this.input_amount = '';
            }else{
                console.log(parseFloat(this.input_amount));
                console.log(this.user[4]);
                swal({
                    title: "Invalid Input",
                    text: "Try again?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  }).then((willDelete) => {
                    this.input_input = '';
                  });
                  this.input_amount = '';
            }
        },
        deposit(){
            var formData = new FormData();
                formData.append('id',this.user[0]);
                formData.append('input_amount',parseFloat(this.input_amount));
                axios.post('deposit',formData).then( response =>{
                    swal("Deposit Successful", "Congrats", "success");
                })
                this.input_amount = '';
        },
        getUser(){
            axios.get('get-user').then( response =>{
                this.user = response.data;
            })
        }
    }
});