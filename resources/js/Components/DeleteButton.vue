<template>
    <button
        class="text-red-600 hover:text-red-800 cursor-pointer"
        @click="confirmDelete"
    >
        Delete
    </button>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
    props: {
        courseId: Number,
        routeName: String, // Assuming it's a string, adjust the type if needed
    },
    methods: {
        confirmDelete() {
            Swal.fire({
                title: 'Confirm Delete',
                text: 'Are you sure you want to delete this course?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteCourse();
                }
            });
        },
        deleteCourse() {
            // Send an AJAX delete request
            axios
                .delete(`/api/courses/${this.courseId}`)
                .then((response) => {
                    //console.log(response);
                    if (response.status === 204) {
                        // Successful deletion, perform any necessary actions
                        Swal.fire('Deleted!', 'The course has been deleted.', 'success').then(()=>this.$inertia.visit(route('courses.index')));
                    } else {
                        Swal.fire('Error!', 'Failed to delete the course.', 'error').then(()=>window.location.href = this.routeName);
                    }
                })
                .catch((error) => {
                    //console.log(error);
                    Swal.fire('Error!', 'An error occurred while deleting the course.', 'error');
                })
                .finally(() => {
                    // Redirect to the specified route

                });
        },
    },
};
</script>
