<template>
    <div class="share">
        <div v-if="message != ''" class="errMsg">
            {{ message }}
        </div>
        <div>
            <form @submit.prevent="share">  
                <label>共有相手のメールアドレス</label>
                <input type="text" v-model="umail" class="umail-form">
                <input type="submit" value="共有する" class="share-submit">
            </form>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            view:false,
            umail:'',
            csrf:document.querySelector("meta[name='csrf-token']").getAttribute('content'), 
            message:''
        }
    },
    props:{
        budget_id:{
            type:Number,
            require:true,
        },
    },
    methods:{
        share(){
            const data = {
                user_mail : this.umail,
                budget_id : this.budget_id,
                _token : this.csrf
            }
            if(confirm('本当に共有しますか？')){
                axios.post('/share',data)
                .then(res => {
                    this.message = res.data;
                })
                .catch(err => {
                    this.message = err.data;
                })
                .finally(() => {
                    this.umail = '';
                    this.view = false;
                })
            }else{
                this.message = '共有を中止しました。';
                this.umail = '';
                this.view = false;
            }

        }
    },
    watch:{
        message(){
            setTimeout(()=>{
                this.message = '';
            },5000);
        }
    }
    
}

</script>

<style lang="scss" scoped>
.share{
    font-size: 1.2rem;
    .share-btn{
        background: rgb(245, 255, 134);
        color:#333;
        border:none;
        cursor:pointer;
        border-radius:5px;
        padding:10  px;
        border: none;
        width: fit-content;
    }

    .umail-form{
        padding:4px;
        border-radius:5px;
        margin:0 3px;
    }

    .errMsg{
        color:#fff;
        background: red;
        border-radius:10px;
        margin: 1rem auto;
        width: fit-content;
        padding:7px;
        font-size:.7rem;    

    }

    .share-submit{
        color: #fff;
        background: var(--submit);
        border: none;
        border-radius: 5px;
    }
}
</style>