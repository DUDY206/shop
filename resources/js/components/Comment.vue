<template>
    <div class="card-comment mt-2">
        <img class="img-circle img-sm" v-bind:src="comment.user_avatar" alt="User Image">

        <div class="comment-text ">
                    <span class="username">
                      {{comment.user_name}}
                        <a class="float-right text-danger"><i class="fas fa-trash-alt"></i></a>
                        <span class="float-right pr-3 ">{{comment.created_date}}</span>

                    </span><!-- /.username -->
            {{comment.body}}
            <br>
            <a class="pr-2 text-primary"><i class="fas fa-thumbs-up"></i>{{comment.like_count}} Like </a>
            <a class="pr-2 text-warning"><i class="fas fa-thumbs-down"></i>{{comment.dislike_count}} Dislike</a>
            <a class="pr-2 " @click="viewReply">{{showReplyText}}</a>
            <a class="text-light float-right" style="right: 5px"><i class="fas fa-pencil-alt"></i> Edit</a>
        </div>
        <!-- /.comment-text -->
        <div v-if="showReplyText === 'Hide reply'">
            <reply-comment  v-for="comment in listReplyComments" :comment="comment" :key="comment.id"></reply-comment>
            <div class="text-center mt-3" v-if="nextUrl">
                <button @click.prevent="fetchReplyComment(nextUrl)" class="btn btn-outline-secondary btn-sm">Load more comments</button>
            </div>
            <new-answer :id="comment.id" :reply_type="'App\\Comment'" class="ml-5" v-if="this.signedIn"></new-answer>

        </div>
    </div>
</template>

<script>
    import ReplyComment from "./ReplyComment";
    import NewAnswer from "./NewAnswer";
    import EventBus from "../event-bus";
    export default {
        components:{
            ReplyComment,NewAnswer
        },
        name: "Comment",
        props:['comment'],
        data(){
            return{
                listReplyComments:[],
                nextUrl: null,
                showReplyText:'Show reply'
            }
        },
        created() {
            EventBus.$on("create_comment_comment",comment => {
                this.listReplyComments.unshift(comment);
            });

            this.fetchReplyComment(`/comments/${this.comment.id}/replyComment`);

        },
        methods:{
            fetchReplyComment(endpoint){
                axios.get(endpoint)
                    .then(({data}) =>{
                        this.listReplyComments.push(...data.data);
                        this.nextUrl = data.next_page_url;
                })
            },
            viewReply(){
                this.showReplyText = (this.showReplyText === 'Show reply') ? 'Hide reply':'Show reply';
            }
        }
    }
</script>

<style scoped>

</style>
