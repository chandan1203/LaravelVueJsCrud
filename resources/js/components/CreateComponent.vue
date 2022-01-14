<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Student</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" v-model="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" v-model="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" v-model="phone" class="form-control" id="phone" placeholder="Enter Phone">
                            </div>
                            <button type="submit" @click.prevent="saveStudent" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">All Student</div>

                    <div class="card-body">
                        <table class="table table-dark">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(student,index) in students.data" :key="student.id">
                                <th scope="row">{{ index + 1}}</th>
                                <td>{{ student.name }}</td>
                                <td>{{ student.email }}</td>
                                <td>{{ student.phone }}</td>
                                <td>
                                    <button @click="editStudent(student.id)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Edit</button>
                                    <button @click="deleteStudent(student.id)" type="button" class="btn btn-danger">Delete</button>

                                </td>
                            </tr>
                        </tbody>
                        </table>
                        <pagination :data="students" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" v-model="editName" class="form-control" id="name" aria-describedby="name" placeholder="Enter name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" v-model="editEmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" v-model="editPhone" class="form-control" id="phone" placeholder="Enter Phone">
                    </div>
                    <button type="submit" @click.prevent="updateStudent(id)" data-dismiss="modal" class="btn btn-success">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                students :{},
                id : '',
                name: '',
                email: '',
                phone: '',
                editName: '',
                editEmail: '',
                editPhone: ''
            }
        },
        mounted() {
            this.getResults();
            console.log('Component mounted.')
        },
        methods: {
            saveStudent(){
                axios.post('save-student',{
                    name : this.name,
                    email: this.email,
                    phone: this.phone,
                })
                .then(response => {
                    this.name = '',
                    this.email = '',
                    this.phone = '',
                    this.getResults();
                });
            },
            getResults(page = 1) {
                axios.get('all-students?page=' + page)
                    .then(response => {
                        console.log(response.data);
                        this.students = response.data;
                    });
		    },
            editStudent(id)
            {
                axios.get('edit-student/'+id)
                .then(response => {
                    this.id = response.data.id;
                    this.editName = response.data.name;
                    this.editEmail= response.data.email;
                    this.editPhone = response.data.phone;

                })
            },
            updateStudent(id)
            {
                axios.put('update-student',{
                    id : this.id,
                    name : this.editName,
                    email : this.editEmail,
                    phone : this.editPhone,
                })
                .then(response => {
                    this.getResults();
                });
            },
            deleteStudent(id)
            {
                axios.delete('delete-student/'+id)
                .then(response => {
                    this.getResults();
                });
            }
        }
    }
</script>
