<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="py-12">
            <div class="flex mb-10 space-x-0">
                <div class="inline-block w-[6.25%] text-center">
                    <span class="cursor-pointer" @click="momentDate = momentDate.subtract(1, 'week')">&lt;&lt;</span>
                </div>
                <div class="inline-block w-[87.5%] shadow">
                    <div class="flex space-x-0 divide-x divide-gray-300">
                        <div
                            class="inline-block w-[14.2857%] pt-3 px-2 py-2 bg-white overflow-hidden"
                            v-for="(dateTaskListTasks, dateTaskListDate) in dateTaskLists"
                            :key="dateTaskListDate"
                        >
                            <TaskList :date="moment(dateTaskListDate)" :tasks="dateTaskListTasks" />
                        </div>
                    </div>
                </div>
                <div class="inline-block w-[6.25%] text-center">
                    <span class="ml-auto cursor-pointer" @click="momentDate = momentDate.add(1, 'week')">&gt;&gt;</span>
                </div>
            </div>
            <div class="flex mb-10 space-x-0">
                <div class="inline-block w-[6.25%] text-center"></div>
                <div class="inline-block w-[87.5%]">
                    <div class="flex space-x-[1%]" v-for="(taskListGroup, index) in taskListGroups" :key="index">
                        <div
                            class="inline-block w-[13.42857%] mb-[1%]"
                            v-for="taskList in taskListGroup.filter((taskList) => taskList != 'add')"
                            :key="taskList.id"
                        >
                            <div v-if="taskList != 'add'" class="px-2 py-2 pt-3 overflow-hidden bg-white shadow">
                                <TaskList :list="taskList" :tasks="taskList.tasks" />
                            </div>
                        </div>
                        <div v-if="taskListGroup.includes('add')" class="inline-block w-[13.42857%] mb-[1%]">
                            <div class="px-2 py-2 pt-3 overflow-hidden bg-white shadow">
                                <input
                                    type="text"
                                    class="w-full p-0 text-2xl text-center placeholder-gray-200 border-0 focus:border-0 focus:outline-none focus:ring-0"
                                    placeholder="Add New List"
                                    v-model="form.name"
                                    @blur="addNewTaskList"
                                    @keyup.enter="addNewTaskList"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inline-block w-[6.25%] text-center"></div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
    import { Inertia } from '@inertiajs/inertia';
    import AppLayout from '@/Layouts/App.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import moment from 'moment';
    import TaskList from '../Components/TaskList.vue';

    export default {
        components: {
            TaskList,
            AppLayout,
            Head,
        },
        props: ['dateTaskLists', 'lists', 'date'],
        data: (instance) => ({
            momentDate: moment(instance.date),
            form: Inertia.form(
                {
                    name: '',
                },
                { preserveScroll: true },
            ),
        }),
        computed: {
            taskListGroups() {
                let lists = _.isObject(this.lists) ? Object.values(this.lists) : this.lists;
                lists.push('add');
                return _.chunk(lists, 7);
            },
        },
        watch: {
            momentDate: (date) =>
                Inertia.post('/dashboard', {
                    date,
                }),
        },
        methods: {
            moment,
            addNewTaskList() {
                if (this.form.processing) {
                    return;
                }
                if (this.form.name) {
                    let instance = this;
                    this.form.post('/task-lists', {
                        preserveScroll: true,
                        onSuccess() {
                            // Reset the name
                            instance.form.name = '';
                        },
                        onError(response) {
                            // @todo handle validation errors
                        },
                    });
                }
            },
        },
    };
</script>
