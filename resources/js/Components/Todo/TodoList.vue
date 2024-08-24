<script>
import TodoItem from "@/Components/Todo/TodoItem.vue";
import FadeInTransition from "@/Components/Transitions/FadeInTransition.vue";
import draggable from "vuedraggable";
import FadeTransition from "@/Components/Transitions/FadeTransition.vue";

export default {
    components: {
        draggable,
        TodoItem,

        FadeTransition,
        FadeInTransition
    },

    emits: {
        todoChange: null,
        todoDelete: null,
        orderChange: null
    },

    props: {
        todos: {
            type: Array
        },
        showReadyTodos: {
            type: Boolean
        }
    },

    data() {
        return {
            todosModel: this.todos ? [...this.todos] : []
        }
    },

    watch: {
        todos: {
            handler(value) {
                this.todosModel = [...value];
            },
            deep: true
        }
    },

    computed: {
        reorderedTodos() {
            const todos = [...this.todosModel];

            todos.forEach((item, index) => {
                item.position = index + 1;
            });

            return todos;
        },

    },

    methods: {
        onChange(data) {
            this.$emit('todoChange', data);
        },

        onDelete(todo) {
            this.$emit('todoDelete', todo)
        },

        onReorderItems() {
            this.$emit('orderChange', this.reorderedTodos);
        }
    }
}
</script>

<template>
    <draggable
        v-model="todosModel"
        tag="ul"
        item-key="id"
        group="todos"
        class="space-y-2"
        :animation="250"
        @change="onReorderItems"
    >
        <template #item="{ element }">
            <todo-item
                v-show="showReadyTodos || !element.is_checked"
                :key="element.id"
                :todo="element"
                @delete="onDelete"
                @change="onChange"
            />
        </template>
    </draggable>
</template>
