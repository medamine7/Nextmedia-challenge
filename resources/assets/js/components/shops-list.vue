<template>
	<div>
		<img v-show="loading" id="preloader" src="/img/preloader.svg" alt="">	
		<transition-group
		    name="custom-classes-transition"
		    enter-active-class="animated fadeInUp"
		    leave-active-class="animated bounceOut"
		    class="container cards-container"
		    tag="div">
		  	<div :key="shop._id" v-for="(shop,index) in shops" class="card animated fadeInUp">
		        <div class="card-header">
		            {{shop.name}}
		        </div>
		        <div class="card-image">
		            <img :src="shop.picture" alt="">
		        </div>
		        <div class="card-footer">
		            <button @click="dislikeShop(shop._id,index);"><i class="far fa-thumbs-down"></i> DISLIKE</button>
		            <button @click="likeShop(shop._id,index)"><i class="far fa-thumbs-up"></i> LIKE</button>
		        </div>
		    </div>
		</transition-group>
	</div>
</template>


<script>
	export default {
		data(){
			return {
				shops : [],
				loading: true
			}
		},
		created(){
			var _this = this;
			axios.get('/getnearbyshops')
			.then(response=>{
				_this.loading=false;
				_this.shops=response.data.shops;
			})
			.catch();
		},

		methods: {
	    	likeShop(id,index){
	    		var _this=this;
	    		axios.post('/shop/like/'+id)
	    		.then(response=>{
	    			_this.shops.splice(index, 1);
	    		})
	    		.catch();
	    	},


	    	dislikeShop(id,index){
	    		var _this=this;
	    		axios.post('/shop/dislike/'+id)
	    		.then(response=>{
	    			_this.shops.splice(index, 1);
	    		})
	    		.catch();
	    	},
	    }
	}
</script>