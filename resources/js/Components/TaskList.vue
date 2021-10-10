<template>
    <div class="relative">
        <h3 class="text-2xl text-center">{{ title }}</h3>

        <span v-if="list" class="absolute top-0 right-0 p-2 text-xs text-red-500 cursor-pointer hover:bg-red-500 hover:text-white" @click="deleteTaskList"
            >X</span
        >

        <div class="relative mb-2">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span v-if="date" class="px-2 text-sm text-gray-500 bg-white" v-text="date.format('MMMM Do, YYYY')"> </span>
            </div>
        </div>

        <div v-if="tasks">
            <Task v-for="task in tasks" :key="task.id" :task="task" />
            <Task v-for="(task, index) in placeholderTasks" :key="((list || {}).id || date.toString()) + '-new-task-' + index" :task="task" />
        </div>
    </div>
</template>

<script>
    import { Inertia } from '@inertiajs/inertia';
    import Task from './Task.vue';

    export default {
        components: {
            Task,
        },
        props: ['date', 'tasks', 'list'],
        data: () => ({
            form: Inertia.form({
                name: '',
            }),
        }),
        computed: {
            title: (instance) => _.get(instance.list, 'name') || instance.date.format('dddd'),
            placeholderTasks() {
                let tasksLenght = _.isObject(this.tasks) ? Object.keys(this.tasks).length : this.tasks.length;

                let lenght = 10 - tasksLenght;

                if (lenght < 1) {
                    lenght = 1;
                }

                return new Array(lenght).fill({ to_do_date: this.date, task_list_id: _.get(this.list, 'id') });
            },
        },
        methods: {
            deleteTaskList() {
                if (this.form.processing) {
                    return;
                }
                let instance = this;
                let form = Inertia.form(instance.list);
                form.delete('/task-lists/' + instance.list.id, {
                    preserveScroll: true,
                    onError(response) {
                        // @todo handle validation/authorizion/404 errors
                    },
                });
            },
        },
    };
</script>
