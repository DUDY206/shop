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
        </div>
    </div>
</template>

<script>
    import ReplyComment from "./ReplyComment";

    export default {
        components:{
            ReplyComment
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
    .card-comments img, .card-comment img {
        height: 1.875rem;
        width: 1.875rem;
        float: left;
        max-width: 30px;
    }
    .img-circle {
        border-radius: 50%;
    }
    .card-comments, .comment-text {
        color: #555555;
        margin-left: 40px;
    }
    .card-comments, .username {
        color: #333333;
        display: block;
        font-weight: 600;
    }
    .card-comments, .text-muted {
        font-size: 12px;
        font-weight: 400;
    }
    .comment-text{
        padding:5px;
        background-color: #c1c1c1;
    }
</style>
