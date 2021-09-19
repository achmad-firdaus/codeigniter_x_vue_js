
var menuName = new Vue({ 
    el: '#navbar-menu-name',
    data: {
        menu1: 'Item',
        menu2: 'Customer',
        menu3: 'Sales',
    }
});

const tableItem = new Vue({
    el:'#tableItem',
    data: {
        errors:[],
        qty:'',
        id_item:'',
    },
    methods:{
        PostsItemStagging:function (event) {
            // use event here as well as id
            const urlCheckQty = location.href+'/checkQty?';
            const i = 1;
            console.log(this.qty)
            console.log(this.id_item)
            fetch(
                urlCheckQty+'inputA='+encodeURIComponent(this.qty)+
                '&inputB='+encodeURIComponent(this.id_item)
            )
            .then(async res => {
            if(res.status === 200) {
                console.log(res);
                // alert('Success, please refresh page!')
            }else if(res.status === 201) {
                alert('Qty tidak mencukupi!');
                $("#qty").val(1);
            }
            });
        },
        PostStagging: function (event) {
            // use event here as well as id
            const urlCheckQty = location.href+'/insertStagging?';
            console.log(this.qty)
            const i = 1;
            if (this.qty > 0) {
                fetch(
                    urlCheckQty+'inputA='+encodeURIComponent(this.qty)+
                    '&inputB='+encodeURIComponent(this.id_item)
                )
                .then(async res => {
                if(res.status === 200) {
                    console.log(res);
                    // alert('Success, please refresh page!')
                }
                });
            }
        }
    }
});
const formStaging = new Vue({
    el:'#formStaging',
    data: {
        errors:[],
        codeTransaksi:'',
        conatct:'',
        cutomer:'',
        // discont:'',
        tothar:'',
        totbay:'',
        label2:'',
    },
    methods:{
        onChange(event){
            console.log(this.cutomer);
            const urlCheckQty = location.href+'/insertCustomer?';
            console.log(this.qty)
            fetch(
                urlCheckQty+'inputA='+encodeURIComponent(this.cutomer)
            )
            .then(async res => {
            if(res.status === 200) {
                console.log(res);
                // alert('Success, please refresh page!')
            }
            });
        },
    }
});

