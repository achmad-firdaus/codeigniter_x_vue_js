
var menuName = new Vue({ 
    el: '#navbar-menu-name',
    data: {
        menu1: 'Item',
        menu2: 'Customer',
        menu3: 'Sales',
    }
});

var nameImg ='';
const apiUrl = location.href+'/insert?';
const apiUrlIMG = location.href+'/insertIMG';
const formItem = new Vue({
    el:'#formItem',
    data: {
        errors:[],
        // nameItem:null,
        nameItem: '',
        unit    :'',
        stock   :'',
        price   :'',
        img   :'',
    },
    methods:{
        previewFiles(event) {
            console.log(event.target.files);

            const URL = apiUrlIMG; 
        
            let data = new FormData();
            data.append('name', 'my-picture');
            data.append('file', event.target.files[0]); 
            console.log(event.target.files[0].name);
            nameImg = event.target.files[0].name;
            let config = {
                header : {
                    'Content-Type' : 'image/png'
                }
            }
            axios.put(
                URL, 
                data,
                config
            ).then(
                response => {
                    console.log('image upload response > ', response)
                }
            )
        },
        checkForm:function(e) {
            e.preventDefault();
            this.errors = [];
            if(this.nameItem === '' || this.unit === '' || this.stock === '' || name.price === '' ) {
                this.errors.push("Not Allowed null");
                console.log(nameImg);
            } else {
                fetch(
                    apiUrl+'inputA='+encodeURIComponent(this.nameItem)+
                    '&inputB='+encodeURIComponent(this.unit)+
                    '&inputC='+encodeURIComponent(this.stock)+
                    '&inputD='+encodeURIComponent(this.price)+
                    '&inputE='+encodeURIComponent(this.img)
                )
                .then(async res => {
                    console.log(res);
                if(res.status === 200) {
                    alert('Success insert, please refresh page!')
                } else if(res.status === 404) {
                    let errorResponse = await res.json();
                    this.errors.push(errorResponse.error);
                }
                });
            }
        }
    }
});
