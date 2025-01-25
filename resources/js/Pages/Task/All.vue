<template>
    <Container>
        <div class="">
            {{ page.props.flash?.message }}
            <div class="">
                <NavLink :href="route('task.edit', { id: null })" class=""
                    >Create New Task</NavLink
                >
            </div>
            <div class="mt-4">
                <table>
                    <tr class="">
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Priority</th>
                    </tr>
                    <tr
                        v-if="tasks.length"
                        v-for="(task, index) in tasks"
                        :key="index"
                        class=""
                    >
                        <td class="p-2">{{ index + 1 }}</td>
                        <td class="p-2">{{ task.name }}</td>
                        <td class="p-2">
                            <select
                                class="rounded border-gray-300"
                                name=""
                                id=""
                                :value="computedStatus(task.status)"
                                @change="(e) => updateStatus(e, task)"
                            >
                                <option
                                    :value="st"
                                    v-for="(st, index) in Object.keys(status)"
                                    :key="index"
                                >
                                    {{ st }}
                                </option>
                            </select>
                        </td>
                        <td class="px-2">
                            <select
                                name=""
                                id=""
                                class="rounded border-gray-300"
                                v-model="priorities[task.priority]"
                                @change="(e) => updatePriority(e, task)"
                            >
                                <option
                                    :value="priority"
                                    v-for="(priority, index) in Object.keys(
                                        priorities
                                    )"
                                    :key="index"
                                >
                                    {{ priority }}
                                </option>
                            </select>
                        </td>

                        <td>
                            <button
                                @click="(e) => destroy(e, task)"
                                class="text-white bg-red-700 px-4 py-2 rounded"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                    <tr v-else class="">
                        <span class="">No Data</span>
                    </tr>
                </table>
            </div>
        </div>
    </Container>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import Container from "../Container.vue";
import { computed } from "vue";

const page = usePage();
const props = defineProps({
    tasks: { type: Array },
    status: { type: Array },
    priorities: { type: Array },
});

const form = useForm({
    name: "",
    status: "",
    priority: "",
});

function updateStatus(e, task) {
    form.name = task.name;
    form.priority = task.priority;
    form.status = e.target.value;
    form.put(route("task.update", { id: task.id }));
}
function updatePriority(e, task) {
    form.name = task.name;
    form.status = task.status;
    form.priority = e.target.value;
    form.put(route("task.update", { id: task.id }));
}

function destroy(e, task) {
    form.delete(route("task.destroy", { id: task.id }));
}

const computedStatus = computed((val) => {
    let bkey = "";
    const keys = Object.keys(props.status);
    keys.forEach((key) => {
        if (props.status[key] == val) {
            key = bkey;
        }
    });
    return bkey;
});
const computedPriority = computed(() => {});
</script>
