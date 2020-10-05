<template>
	<div>
		<a :href="parentRoute" @click="downloaded">
			<div class=".delete-offer-container delete-offer-container-pdf">
		    	<img :src="pdfImage">
		    </div>
		</a>	
	</div>
</template>

<script>
	import axios from 'axios'

	export default {
		props: ['parentRoute', 'pdfImage'],
		methods:{

			downloaded: function(){

				const url= '/downloaded';

				axios.post(url, {add: 1}).then((response)=>{
					console.log(response.data);
				});
			}
		}
	}
</script>