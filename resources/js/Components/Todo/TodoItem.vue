<script>
import draggable from 'vuedraggable';
import {GripVerticalIcon, TrashIcon, SquarePenIcon} from "lucide-vue-next";

export default {
    components: {
        draggable,
        TrashIcon,
        SquarePenIcon,
        GripVerticalIcon
    },

    emits: {
        change: null,
        delete: null,
    },

    props: {
        todo: {
            type: Object
        }
    },

    data() {
        return {
            name: this.todo?.name ?? '',
            isEditing: false,
            isChecked: this.todo?.is_checked ?? false,
        }
    },

    methods: {
        onChecked() {
            this.isChecked = !this.isChecked;

            const updatedTodo = {...this.todo, is_checked: this.isChecked};

            this.$emit('change', {
                todo: updatedTodo
            });
        },

        async editTodo() {
            this.isEditing = true;

            await this.$nextTick();

            this.$refs.nameInput.focus();
        },

        confirmEdit() {
            if (this.name === this.todo.name) {
                this.isEditing = false;
                return;
            }

            const updatedTodo = {...this.todo, name: this.name};

            this.$emit('change', {
                todo: updatedTodo, cb: () => {
                    this.isEditing = false;
                }
            });
        },

        deleteTodo() {
            this.$emit('delete', this.todo);
        }
    }
}
</script>

<template>
    <li
        :class="{ 'bg-indigo-50': isEditing }"
        class="mt-5 flex items-center shadow-sm border dark:border-gray-700 rounded-md ps-4 pe-2 py-2 group transition"
    >
        <div
            v-if="!isEditing"
            @click="onChecked"
            :class="{'line-through': isChecked}"
            class="flex items-center mr-auto w-full text-base cursor-pointer"
        >
            <input type="checkbox"
                   :checked="isChecked"
                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            >
            <span class="ml-3 mt-0.5">{{ todo?.name }}</span>
        </div>

        <div v-else class="flex items-center mr-auto w-full text-base">
            <square-pen-icon
                size="18"
                class="inline-block cursor-pointer opacity-75 hover:opacity-100 transition mr-3"
            />
            <input
                v-model="name"
                ref="nameInput"
                type="text"
                class="border-none w-full focus:ring-0 px-0 pt-[2px] pb-0 bg-transparent"
                @blur="confirmEdit"
                @keydown.enter="confirmEdit"
            >
        </div>

        <div
            v-if="!isEditing"
            class="space-x-4 flex flex-nowrap me-4 opacity-0 group-hover:opacity-100 transition ml-2"
        >
            <square-pen-icon
                @click="editTodo"
                size="16"
                class="inline-block cursor-pointer opacity-75 hover:opacity-100 transition"
            />

            <trash-icon
                @click="deleteTodo"
                size="16"
                class="inline-block cursor-pointer opacity-75 hover:opacity-100 transition"
            />
        </div>

        <grip-vertical-icon size="20" class="inline-block cursor-pointer flex-shrink-0"/>
    </li>
</template>

