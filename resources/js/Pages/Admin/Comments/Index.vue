<template>
    <admin-layout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-semibold leading-tight text-gray-800">
                        Bình luận
                    </h1>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow sm:rounded-lg">
                    <div class="relative">
                        <div class="overflow-hidden overflow-x-auto relative">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                        >
                                            Người dùng
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                        >
                                            Nội dung
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                        >
                                            Thời gian
                                        </th>
                                        <th
                                            scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap"
                                        >
                                            <span class="sr-only">Thao tác</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr
                                        v-for="comment in comments.data"
                                        :key="comment.id"
                                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ comment.user.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-pre-line">
                                            {{ comment.content }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right tabular-nums">
                                            {{ dateFilter(comment.created_at) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <ul class="list-none flex justify-center">
                                                <li class="inline">
                                                    <button
                                                        type="button"
                                                        class="text-sm text-gray-500 hover:text-indigo-700"
                                                        @click="showCommentUpdateModal(comment)"
                                                    >
                                                        <svg
                                                            class="w-5 h-5"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20"
                                                            fill="currentColor"
                                                        >
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path
                                                                fill-rule="evenodd"
                                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                clip-rule="evenodd"
                                                            />
                                                        </svg>
                                                    </button>
                                                </li>
                                                <li class="inline">
                                                    <button
                                                        type="button"
                                                        class="text-sm text-gray-500 hover:text-red-700"
                                                        @click="confirmCommentDeletion(comment)"
                                                    >
                                                        <svg
                                                            class="w-5 h-5"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20"
                                                            fill="currentColor"
                                                        >
                                                            <path
                                                                fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"
                                                            />
                                                        </svg>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <bolt-pagination-simple
                            :from="comments.from"
                            :to="comments.to"
                            :total="comments.total"
                            :prev-page-url="comments.prev_page_url"
                            :next-page-url="comments.next_page_url"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- Update comment modal -->
        <bolt-dialog-modal
            :show="commentBeingUpdated"
            @close="commentBeingUpdated = null"
        >
            <template #title>
                Cập nhật nội dung bình luận
            </template>

            <template #content>
                <div v-if="updateCommentForm.content">
                    <bolt-label
                        for="content"
                        value="Nội dung"
                    />
                    <bolt-textarea
                        id="content"
                        v-model="updateCommentForm.content"
                        rows="5"
                        class="mt-1 block w-full"
                    />
                </div>
            </template>

            <template #footer>
                <bolt-secondary-button @click="commentBeingUpdated = null">
                    Bỏ qua
                </bolt-secondary-button>

                <bolt-danger-button
                    class="ml-2"
                    :class="{ 'opacity-25': updateCommentForm.processing }"
                    :disabled="updateCommentForm.processing"
                    @click="updateComment"
                >
                    Xác nhận
                </bolt-danger-button>
            </template>
        </bolt-dialog-modal>

        <!-- Comment deletion modal -->
        <bolt-confirmation-modal
            :show="commentBeingDeleted"
            @close="commentBeingDeleted = null"
        >
            <template #title>
                Xóa bình luận
            </template>

            <template #content>
                Bạn có chắc chắn xóa bình luận này?
            </template>

            <template #footer>
                <bolt-secondary-button @click="commentBeingDeleted = null">
                    Bỏ qua
                </bolt-secondary-button>

                <bolt-danger-button
                    class="ml-2"
                    :class="{ 'opacity-25': deleteCommentForm.processing }"
                    :disabled="deleteCommentForm.processing"
                    @click="deleteComment"
                >
                    Xác nhận
                </bolt-danger-button>
            </template>
        </bolt-confirmation-modal>
    </admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout";
    import BoltPaginationSimple from "@/Components/PaginationSimple";
    import BoltConfirmationModal from "@/Components/ConfirmationModal";
    import BoltDialogModal from "@/Components/DialogModal";
    import BoltSecondaryButton from "@/Components/SecondaryButton";
    import BoltDangerButton from "@/Components/DangerButton";
    import BoltTextarea from "@/Components/Textarea";
    import BoltLabel from "@/Components/Label";
    import dateFilter from "@/Filters/date";
    export default {
        name: "Index",
        components: {AdminLayout, BoltPaginationSimple, BoltConfirmationModal, BoltDialogModal, BoltSecondaryButton, BoltDangerButton, BoltTextarea, BoltLabel},
        props: ['comments'],
        data() {
            return {
                commentBeingDeleted: null,
                deleteCommentForm: this.$inertia.form(),
                commentBeingUpdated: null,
                updateCommentForm: this.$inertia.form({
                    content: null,
                }),
            };
        },
        methods: {
            dateFilter,
            confirmCommentDeletion(comment) {
                return this.commentBeingDeleted = comment;
            },
            deleteComment() {
                return this.deleteCommentForm.delete(route('admin.comments.destroy', this.commentBeingDeleted), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.commentBeingDeleted = null),
                });
            },
            showCommentUpdateModal(comment) {
                this.commentBeingUpdated = comment;
                this.updateCommentForm.content = comment.content;
            },
            updateComment() {
                return this.updateCommentForm.put(route('admin.comments.update', this.commentBeingUpdated), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.commentBeingUpdated = null),
                });
            },
        },
    };
</script>

<style scoped>

</style>
