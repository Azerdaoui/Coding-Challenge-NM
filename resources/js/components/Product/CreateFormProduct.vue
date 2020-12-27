<template>
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">

                    <div class="alert alert-danger">
                        <span v-if="errors">{{ errors }} </span>
                    </div>
                   
                    <form class="form">
                        
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                           
                            <input type="text" class="form-control" :class="errors.name != null ? 'is-invalid':''" v-model="product.name">
                           
                            <div v-if="errors.name">
                                <small class="text-danger">{{ errors.name[0] }}</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            
                            <input type="text" class="form-control" :class="errors.price != null ? 'is-invalid':''" v-model="product.price">
                            
                            <div v-if="errors.price">
                                <small class="text-danger">{{ errors.price[0] }}</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            
                            <select v-model="product.categoryId" :class="errors.categoryId != null ? 'is-invalid':''" class="form-control">
                                <option value="">Select</option>
                                <option v-for="(category, index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                            </select>

                            <div v-if="errors.categoryId">
                                <small class="text-danger">{{ errors.categoryId[0] }}</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                           
                            <textarea class="form-control" cols="10" rows="4" :class="errors.description != null ? 'is-invalid':''" v-model="product.description"></textarea>
                           
                            <div v-if="errors.description">
                                <small class="text-danger">{{ errors.description[0] }}</small>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            
                            <input type="file" accept="image/*" @change="fieldChange" :class="errors.image != null ? 'is-invalid':''">
                            
                            <div v-if="errors.image">
                                <small class="text-danger">{{ errors.image[0] }}</small>
                            </div>
                        </div>

                    </form>

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click.prevent="store">Submit</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            errors: [],
            categories: [],
            product: {
                name:'',
                description:'',
                price:0,
                categoryId:''
            },
            attachments:[],
            request: new FormData
        }
    },

    methods: {
        async store() {
            try
            {
                this.request.append('name', this.product.name)
                this.request.append('categoryId', this.product.categoryId)
                this.request.append('description', this.product.description)
                this.request.append('price', this.product.price)
                if(this.attachments.length > 0)
                {
                    this.request.append('image', this.attachments[0])
                }

                const config = {headers:{'Content-Type': 'multipart/request-data'}};

                let response = await axios.post('/products/store', this.request, config)

                if(response.data.success == true) {
                    window.location.reload()
                }
            }
            catch(error) {
                console.log(error.response.data.error)

                this.errors = error.response.data.error
            }
        },

        fieldChange(e, file, fileList){

            let selectedFiles = e.target.files
            if(!selectedFiles.length)
            {
                return false
            }
            this.attachments = [];
            for(let i=0;i<selectedFiles.length;i++)
            {
                this.attachments.push(selectedFiles[i])
            }
        },

        async getAllCategories()
        {
            let response = await axios.get('/categories/all')

            this.categories = response.data
        }
    },

    mounted(){
        this.getAllCategories()
    }
}
</script>