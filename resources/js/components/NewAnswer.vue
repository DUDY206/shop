<template>
    <div class="card-comment mt-2">
        <img class="img-circle img-sm" v-bind:src="avatar_src" alt="User Image">

        <div class="comment-text ">
            <form @submit.prevent="create">
                <div class="form-group">
                    <textarea name="body" id=""  class="form-control" required v-model="body" ></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" :disabled="isInvalid" :class="button_class" value="Comment">
                </div>

            </form>
        </div>

    </div>
</template>

<script>
    import EventBus from "../event-bus";
    export default {
        name: "NewAnswer",
        props:['id','reply_type'],
        data(){
            return {
                body:'',
                avatar_src:window.Auth.user.avata_src,
            }
        },
        methods:{
            create(){
                axios.post(`products/${this.id}/comments `,{
                    body: this.body,
                    reply_id:this.id,
                    reply_type:this.reply_type,
                    user_id:window.Auth.user.id,
                })
                    .catch(error=>{
                        this.$toast.error(error.response.data.message,"Error")
                    })
                    .then(({data}) => {
                        let type = this.reply_type === 'App\\Product' ? 'create_comment_product':'create_comment_comment';
                        this.$toast.success(data.message,"Success");
                        this.body = '';
                        EventBus.$emit(type,data.comment);
                    })
                ;
            }
        },
        computed:{
            isInvalid(){
                return !this.signedIn || (this.body.length < 1);
            },
            button_class(){
                return this.isInvalid ? 'btn btn-outline-primary btn-sm' : 'btn btn-primary btn-sm';
            }
        }
    }
</script>

<style scoped>

</style>
