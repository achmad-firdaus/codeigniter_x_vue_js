
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
        nameCustomer: '',
        conatct    :'',
        email   :'',
        address   :'',
        discont   :'',
        type   :'',
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
                    apiUrl+'inputA='+encodeURIComponent(this.nameCustomer)+
                    '&inputB='+encodeURIComponent(this.conatct)+
                    '&inputC='+encodeURIComponent(this.email)+
                    '&inputD='+encodeURIComponent(this.address)+
                    '&inputE='+encodeURIComponent(this.discont)+
                    '&inputF='+encodeURIComponent(this.type)
                )
                .then(async res => {
                    console.log(res);
                if(res.status === 200) {
                    alert('Success, please refresh page!')
                } else if(res.status === 404) {
                    let errorResponse = await res.json();
                    this.errors.push(errorResponse.error);
                }
                });
            }
        }
    }
});
