<script>
    import { ref, watch } from 'vue';
    import relativeTime from 'dayjs/plugin/relativeTime';
    import dayjs from 'dayjs';
    dayjs.extend(relativeTime);

    export default {
        name: 'RelativeTime',

        props: {
            date: {
                required: true
            }
        },

        setup(props, context) {
            let date = ref(props.date);

            watch(() => props.date, (value) => {
                date.value = value;
            });

            setInterval(() => {
                date.value = dayjs(date.value);
            }, 60000);

            return () => context.slots.default({
                fromNow: date.value.fromNow()
            });
        }
    }
</script>

<style scoped>

</style>
