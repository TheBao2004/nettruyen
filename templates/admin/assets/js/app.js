

// Options chap image ----------------------------------------------------------------


let html_chap_img = `<div class="item_chap_img row mb-black">
   
<div class="col-7">

    <div class="form-group">
    <label >Link image</label>
    <textarea class="form-control inputLink" name="chap[link_img][]" rows="5"></textarea>
    </div>

    <span class="btn btn-warning text-light p-2 w-100 save_chap_img">Save image</span>

    <div class="form-group">
    <label for="exampleInputEmail1">Stt image</label>
    <input type="text" class="form-control" name="chap[stt_img][]" placeholder="Enter">
    </div>

</div>

<div class="col-4 text-center">

<img src="" alt="erorr image" width="80%" class="b-shadow inputImage">

</div>

<div class="col-1">
    <div class="form-group">
    <span class="btn btn-danger text-light p-2 w-100 remove_chap_img"><i class="fa fa-times"></i></span>
    </div>
</div>

</div>`; 


	let add_chap_img = document.querySelector('.add_chap_img');
	let box_chap_img = document.querySelector('.box_chap_img');


	if(add_chap_img != null && box_chap_img != null){

		add_chap_img.addEventListener('click', () => {

			let chap_img_parser = new DOMParser().parseFromString(html_chap_img, 'text/html').querySelector('.item_chap_img');
			box_chap_img.appendChild(chap_img_parser);

			let remove_chap_imgs = box_chap_img.querySelectorAll('.remove_chap_img');

			if(remove_chap_imgs != null){
				remove_chap_imgs.forEach((item) => {
					item.addEventListener('click', (e) => {
						let remove = e.target;
						while(true){
							remove = remove.parentElement;
							if(remove.classList.contains('item_chap_img')) break;
						}
						remove.remove();
					});
				});
			}

		});



		

		let remove_chap_imgs = box_chap_img.querySelectorAll('.remove_chap_img');

		if(remove_chap_imgs != null){
			remove_chap_imgs.forEach((item) => {
				item.addEventListener('click', (e) => {
					let remove = e.target;

					if(confirm('Are you sure remove !')){
					while(true){
						remove = remove.parentElement;
						if(remove.classList.contains('item_chap_img')) break;
					}
					remove.remove();  
					}


				});
			});
		}

	}




if(add_chap_img != null && box_chap_img != null){

// if(inputLink != null && inputImage != null ){

    let save_chap_imgs = document.querySelectorAll('.save_chap_img');
    save_chap_imgs.forEach((item)=>{

    item.addEventListener('click', (e) => {
        let addSrc = e.target.parentElement;
        let child1 = addSrc.children[0];
        child1 = child1.children[1];
        let postLink = child1; 
        let child2 = addSrc.parentElement; 
        child2 = child2.children;
        let postIamge = child2[1].children[0];
        postIamge.src = postLink.value;

    });

    });

    add_chap_img.addEventListener('click', () => {
let save_chap_imgs = document.querySelectorAll('.save_chap_img');
    save_chap_imgs.forEach((item)=>{

    item.addEventListener('click', (e) => {
        let addSrc = e.target.parentElement;
        let child1 = addSrc.children[0];
        child1 = child1.children[1];
        let postLink = child1; 
        let child2 = addSrc.parentElement; 
        child2 = child2.children;
        let postIamge = child2[1].children[0];
        postIamge.src = postLink.value;
    });

    });
    });

// }

}

// Options chap image ----------------------------------------------------------------


// Options slide ----------------------------------------------------------------



let html_slide = `<div class="item_slide row mb-black">

<div class="col-10">

<div class="form-group">
    <label for="">Image 1</label>
    <input type="text" class="form-control" name="slide[image1][]" placeholder="Enter">
</div>

<div class="form-group">
    <label for="">Image 2</label>
    <input type="text" class="form-control" name="slide[image2][]" placeholder="Enter">
</div>

<div class="form-group">
    <label for="">Title</label>
    <textarea class="form-control" placeholder="Enter" name="slide[title][]" rows="3"></textarea>
</div>

<div class="form-group">
    <label for="">Description</label>
    <textarea class="form-control" placeholder="Enter" name="slide[description][]" rows="3"></textarea>
</div>

<div class="form-group">
    <label for="    ">Link</label>
    <input type="text" class="form-control" name="slide[link][]" placeholder="Enter">
</div>


</div>

<div class="col-2 text-center">

    <span class="btn btn-danger text-light p-2 w-75 remove_slide"><i class="fa fa-times"></i></span>

</div>


</div>`; 


let add_slide = document.querySelector('.add_slide');
let box_slides = document.querySelector('.box_slides');

if(add_slide != null && box_slides != null){

    add_slide.addEventListener('click', () => {

        let slide_parser = new DOMParser().parseFromString(html_slide, 'text/html').querySelector('.item_slide');
        box_slides.appendChild(slide_parser);

        let remove_slides = box_slides.querySelectorAll('.remove_slide');

        if(remove_slides != null){
            remove_slides.forEach((item) => {
                item.addEventListener('click', (e) => {
                    let remove = e.target;
                    while(true){
                        remove = remove.parentElement;
                        if(remove.classList.contains('item_slide')) break;
                    }
                    remove.remove();
                });
            });
        }

    });

    let remove_slides = box_chap_img.querySelectorAll('.remove_slide');

    if(remove_slides != null){
        remove_slides.forEach((item) => {
            item.addEventListener('click', (e) => {
                let remove = e.target;

                if(confirm('Are you sure remove !')){
                while(true){
                    remove = remove.parentElement;
                    if(remove.classList.contains('item_slide')) break;
                }
                remove.remove();  
                }


            });
        });
    }

}




// Options slide ----------------------------------------------------------------



// Profile ----------------------------------------------------------------

let post_profile_img = document.querySelector('.post_profile_img');
let save_profile_img = document.querySelector('.save_profile_img');
let input_profile_img = document.querySelector('.input_profile_img');

if(post_profile_img != null && save_profile_img != null && input_profile_img != null){

    save_profile_img.addEventListener('click', (e)=>{
        input_profile_img.src = post_profile_img.value;
    });

}




// Profile ----------------------------------------------------------------

// Light ----------------------------------------------------------------


let lights = document.querySelectorAll('.light');

if(lights != null){
lights.forEach((item)=>{
    setInterval(()=>{
            item.classList.toggle('text-danger');   
    }, 1500);
});
}

// Light ----------------------------------------------------------------
