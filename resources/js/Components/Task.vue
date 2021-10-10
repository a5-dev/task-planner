<template>
    <div class="inline-flex w-full border-b border-gray-300 border-dotted cursor-pointer">
        <div class="w-4">
            <input
                v-if="task.id"
                type="checkbox"
                class="w-3 h-3 text-gray-300 border-gray-300 rounded cursor-pointer focus:ring-0"
                @change="toggleCompleted"
                v-model="form.completed"
            />
            <span v-else class="w-3 h-3 text-white">&nbsp;</span>
        </div>
        <div class="w-1 border-l border-r border-red-500"></div>
        <div v-if="task.id" class="flex w-full pl-1">
            <span :class="task.completed_at ? 'line-through text-gray-200' : ''" v-text="task.summary"></span>
            <button @click="deleteTask" class="px-1 ml-auto text-xs text-red-500 hover:bg-red-500 hover:text-white">x</button>
        </div>
        <div v-else class="flex w-full pl-1">
            <input
                type="text"
                class="w-full p-0 placeholder-gray-200 border-0 outline-none ring-0 focus:outline-none focus:border-0 focus:ring-0"
                v-model="form.summary"
                @blur="addNewTask"
                @keyup.enter="addNewTask"
            />
        </div>
    </div>
</template>

<script>
    import { Inertia } from '@inertiajs/inertia';
    export default {
        props: ['task'],
        data: (instance) => ({
            form: Inertia.form({
                id: instance.task.id || null,
                summary: instance.task.summary || '',
                to_do_date: instance.task.to_do_date || '',
                task_list_id: instance.task.task_list_id || '',
                completed: !!instance.task.completed_at,
            }),
        }),
        methods: {
            addNewTask() {
                if (this.form.processing) {
                    return;
                }
                if (this.form.summary) {
                    let instance = this;
                    this.form.post('/tasks', {
                        preserveScroll: true,
                        onSuccess() {
                            // Reset the summary
                            instance.form.summary = '';
                        },
                        onError(response) {
                            // @todo handle validation errors
                        },
                    });
                }
            },
            toggleCompleted() {
                if (this.form.processing) {
                    return;
                }
                let instance = this;
                this.form.put('/tasks/' + instance.task.id, {
                    preserveScroll: true,
                    onError(response) {
                        // @todo handle validation/authorizion/404 errors
                    },
                });
            },
            deleteTask() {
                if (this.form.processing) {
                    return;
                }
                let instance = this;
                this.form.delete('/tasks/' + instance.task.id, {
                    preserveScroll: true,
                    onError(response) {
                        // @todo handle validation/authorizion/404 errors
                    },
                });
            },
        },
    };
</script>
