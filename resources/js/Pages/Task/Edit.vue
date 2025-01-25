<template>
    <Container>
        <div class="">
            {{ page.props?.flash?.message }}
            <form action="" class="" @submit="submit">
                <div class="">
                    <InputLabel value="Name" />
                    <TextInput type="text" name="" id="" v-model="form.name" />
                    <InputError :message="form.errors.name" />
                </div>
                <div class="">
                    <InputLabel value="Status" />
                    <select
                        name=""
                        id=""
                        class="rounded border-gray-300"
                        v-model="form.status"
                    >
                        <option
                            class="capitalize"
                            :value="status[st]"
                            v-for="(st, index) in Object.keys(status)"
                            :key="index"
                        >
                            {{ st }}
                        </option>
                    </select>
                    <InputError :message="form.errors.status" />
                </div>
                <div class="">
                    <InputLabel value="Priority" />
                    <select
                        name=""
                        id=""
                        class="rounded border-gray-300"
                        v-model="form.priority"
                    >
                        <option
                            class="capitalize"
                            :value="priorities[priority]"
                            v-for="(priority, index) in Object.keys(priorities)"
                            :key="index"
                        >
                            {{ priority }}
                        </option>
                    </select>
                    <InputError :message="form.errors.priority" />
                </div>

                <button
                    class="px-4 py-2 text-white border border-blue-300 rounded bg-blue-800 mt-2"
                >
                    {{ task ? "Update" : "Create" }}
                </button>
            </form>
        </div>
    </Container>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import Dashboard from "../Dashboard.vue";
import Container from "../Container.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const page = usePage();
const props = defineProps({
    task: { type: Object },
    status: { type: Array },
    priorities: { type: Array },
});

const form = useForm({
    name: props.task?.name ?? "",
    status: props.task?.name ?? "",
    priority: props.task?.name ?? "",
});

function submit(e) {
    e.preventDefault();
    if (props.task) {
        form.put(route("task.update"));
    } else {
        form.post(route("task.store"));
    }
}
</script>
