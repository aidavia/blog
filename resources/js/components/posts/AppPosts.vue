<template>
    <div class="space-y-16">
        <div class="" v-for="post in posts" :key="post.uuid">
            <a class="block" :href="`/posts/${post.uuid}`">
                <h1 class="text-3xl sm:text-4xl leading-10 font-extrabold tracking-tight text-gray-900">
                    {{ post.title }}
                </h1>
                <p class="mt-5 text-gray-500">
                    {{ post.teaser }}
                </p>
            </a>
        </div>
    </div>
</template>

<script>
    import { onMounted } from 'vue';
    import usePosts from '../../api/usePosts';

    export default {
        name: 'AppPosts',

        setup() {
            const { posts, fetchPosts } = usePosts();

            onMounted(fetchPosts);

            return {
                posts
            }
        }
    }
</script>

<style scoped>

</style>
