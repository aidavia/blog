<template>
    <div class="absolute w-full left-0 top-0 p-6 flex justify-between items-center space-x-6">
        <div class="flex-grow flex items-center">
            <span class="mr-1">/</span>
            <input type="text" class="p-0 border-none focus:ring-0 w-full"
                   v-model="post.slug" spellcheck="false"
                   v-on:click="$event.target.select()"
            >
        </div>
        <div class="flex items-center space-x-6">
            <RelativeTime :date="lastSaved" v-if="lastSaved">
                <template v-slot:default="{ fromNow }">
                    <span class="text-sm text-gray-500">{{ fromNow }}</span>
                </template>
            </RelativeTime>

            <button v-on:click="post.published = !post.published"
                    class="text-sm font-medium"
                    v-bind:class="{ 'text-pink-500': post.published }"
            >
                {{ !post.published ? 'Publish' : 'Unpublish' }}
            </button>

            <a :href="`/posts/${post.uuid}`" class="text-sm font-medium text-gray-800">Preview</a>
        </div>
    </div>
    <ResizeTextarea v-if="post.title">
        <template v-slot:default="{ resize, el }">
            <textarea v-model="post.title"
                      v-on:input="resize"
                      :ref="el"
                      class="w-full text-center text-4xl lg:text-6xl leading-10 font-extrabold
                  tracking-tight text-gray-900 border-none focus:ring-0 resize-none p-0"></textarea>
        </template>
    </ResizeTextarea>

    <Editor
        v-model:modelValue="post.body"
        v-model:teaserValue="post.teaser"
        class="mt-16"
    />
</template>

<script>
    import useAdminPosts from '../../api/useAdminPosts';
    import { onMounted, watch, watchEffect, ref } from 'vue';
    import _ from 'lodash';
    import slugify from 'slugify';
    import dayjs from 'dayjs';
    import ResizeTextarea from '../ui/ResizeTextarea';
    import Editor from '../ui/Editor';
    import RelativeTime from '../ui/RelativeTime'

    export default {
        name: 'AppEditPost',

        components: {
            RelativeTime,
            ResizeTextarea,
            Editor
        },

        props: {
            uuid: {
                required: true,
                type: String
            }
        },

        setup: function (props) {
            const {post, fetchPost, updatePost} = useAdminPosts();
            const lastSaved = ref(null);

            const patchPost = async () => {
                await updatePost(props.uuid);
                lastSaved.value = dayjs();
            }

            const replaceSlug = () => {
                const slug = post.value.slug;

                if (slug.charAt(slug.length - 1) === ' ') {
                    return;
                }

                post.value.slug = slug ? slugify(slug, { strict: true }) : post.value.uuid;
            }

            onMounted(async () => {
                await fetchPost(props.uuid);

                watchEffect(() => {
                    replaceSlug();
                });

                watch(() => _.cloneDeep(post), _.debounce(() => {
                    patchPost();
                }, 500));
            });

            return {
                post,
                lastSaved
            }
        }
    }
</script>

<style scoped>

</style>
