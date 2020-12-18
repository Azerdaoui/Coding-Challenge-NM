<template>
    <div>
        <div class="row">
            <div class="col-3">
                <label>Category</label> <br>
                <select v-model="data.category_id" @change="getProducts()" class="form-control">
                    <option value="">Select</option>
                    <option v-for="(category, index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                </select>
            </div>
            <div class="col-3">
                <label>Sort By</label> <br>
                <select v-model="data.sortBy" @change="getProducts()" class="form-control">
                    <option value="" disabled>Sort by..</option>
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                </select>
            </div>
        </div>

        <div class="row my-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="index">
                        <th scope="row">{{ ++index }}</th>
                        <td><img :src="product.image" width="100"></td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.category.name }}</td>
                        <td>{{ product.description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            products: [],
            categories: [],
            data: {
                sortBy:'',
                category_id:''
            }
        }
    },

    methods: {
        async getProducts(url = '/products/listing') {
            let response = await axios.get(url, { params: this.data });
            this.products = response.data.products;
            // axios.get(url, { params: this.data })
            //     .then(response => {
            //         this.products = response.data.products.data
            //     }).catch(errors => {
            //         console.log(errors);
            //     });
        },

        async getAllCategories()
        {
            let response = await axios.get('/categories/all')

            this.categories = response.data
        }
    },

    mounted(){
        this.getProducts()
        this.getAllCategories()
    }
}
</script>