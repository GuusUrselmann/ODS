<template>
    <div class="container-fluid menubuilder p-2 rounded">
        <div class="row border-bottom mb-2">
            <div class="col-9">
                <h4>Menu layout</h4>
            </div>
            <div class="col-3">
                <h4>Builder</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <div class="categories rounded bg-light pt-2 pb-2 pl-3 pr-3">
                    <div class="category pb-2" v-for="(category, index) in menu" :key="index">
                        <input type="hidden" :name="'categories['+category.id+']'">
                        <div class="category-header border-bottom pl-2">
                            <h4>{{category.name}}</h4>
                            <div class="product-select float-right mr-5">
                                <div class="select-input">
                                    <Select2 :options="productsOptions" v-model="productAdd[index]" :settings="{placeholder: 'Producten...'}" />
                                </div>
                                <div class="select-button">
                                    <div class="btn btn-success" v-on:click="addProduct(index)">Toevoegen</div>
                                </div>
                            </div>
                            <div class="category-remove float-right bg-danger rounded-circle text-center" v-on:click="removeCategory(index)">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                        <div class="category-products row p-2">
                            <div class="product col-3" v-for="(product, productIndex) in category.products" :key="productIndex">
                                <input type="hidden" :name="'categories['+category.id+'][]'" :value="product.id">
                                <div class="card">
                                    <div class="card-header p-1">
                                        {{product.name}}
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="product-image background-cover" :style="{backgroundImage: 'url('+asset+product.image_path+')'}"></div>
                                        <span class="badge rounded product-price badge-dark pl-1 pr-1">€ {{product.price}}</span>
                                    </div>
                                    <div class="product-remove bg-danger rounded-circle text-center" v-on:click="removeProduct(index, productIndex)">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                            </div>
                            <div v-if="category.products.length == 0" class="products-empty col-6 p-3 bg-white h5 border-2 border-info border-dashed">
                                Kies een product om toe te voegen
                            </div>
                        </div>
                    </div>
                    <div v-if="menu.length == 0" class="categories-empty p-3 bg-white h4 border-2 border-info border-dashed">
                        Kies een categorie om toe te voegen
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="builder-menu">
                    <div class="menu-categories">
                        <Select2 :options="categoriesOptions" v-model="categoryAdd" :settings="{placeholder: 'Categorieën...'}" />
                        <div class="btn btn-success float-right mt-2" v-on:click="addCategory">Toevoegen</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Select2 from 'v-select2-component';
    export default {
        components: {
            Select2,
        },
        data() {
            return {
                categoryAdd: '',
                productAdd: [],
                categoriesOptions: this.categoriesData.map(function(cat) {return {id: cat.id, text: cat.name}}),
                productsOptions: this.productsData.map(function(product) {return {id: product.id, text: product.name}}),
            }
        },
        props: {
            categoriesData: null,
            productsData: null,
            menuData: null,
        },
        methods: {
            addCategory() {
                this.$store.commit('addCategoryToMenu', this.categorySelected)
            },
            removeCategory(catID) {
                this.$store.commit('removeCategoryFromMenu', catID)
            },
            addProduct(catID) {
                this.$store.commit('addProductToCategory', {cat: catID, product: this.productSelected(catID)})
            },
            removeProduct(catID, productID) {
                this.$store.commit('removeProductFromCategory', {catID: catID, productID: productID})
            },
            productSelected(catID) {
                let selectedProduct = this.productAdd[catID]
                let productObj = {}
                this.productsData.forEach(function(product) {
                    if(product.id == selectedProduct) {
                        productObj = product
                    }
                })
                return productObj
            },
        },
        computed: {
            menu() {
                return this.$store.getters.getMenu
            },
            categorySelected() {
                let selectedCat = this.categoryAdd;
                let catObj = {}
                this.categoriesOptions.forEach(function(category) {
                    if(category.id == selectedCat) {
                        catObj = category
                    }
                })
                return catObj
            },
            url() {
                return url();
            },
            asset() {
                return asset();
            }
        },
        mounted() {
            if(this.menuData != null) {
                this.$store.dispatch('initMenu', this.menuData)

            }
            else {
                console.log('no data set')
            }
        },
    }
</script>
