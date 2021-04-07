let fiche = document.getElementById("dog-card");
let image = document.getElementById("dog-card-img");
let info = document.getElementById("dog-info");

let figures = document.getElementsByClassName('vignet-dog');

const dogInfoElement = document.querySelectorAll('[data-dog-to-js]');
const dogInfoObject = Array.from(dogInfoElement).map(
        item => JSON.parse(item.dataset.dogToJs)
    );




const createBlock = (name) => {

    for(let i = 0; i < dogInfoObject.length; i++)
    {
        if (dogInfoObject[i].name.toLowerCase() === name)
        {
            fiche.classList.remove('card-hidden');
            info.children[0].textContent = ' ' + dogInfoObject[i].name + '  ' + dogInfoObject[i].breeder;
            if (dogInfoObject[i].sex === "Mâle")
            {
                info.children[1].textContent = " Né le " + dogInfoObject[i].birth;
                info.children[2].classList.add("fa-mars");
                info.children[2].classList.remove("fa-venus");
            }
            else 
            {
                info.children[1].textContent = " Née le " + dogInfoObject[i].birth;
                info.children[2].classList.add("fa-venus");
                info.children[2].classList.remove("fa-mars");

            }
            info.children[0].classList.add("fa-paw");
            info.children[1].classList.add("fa-calendar-check");
            info.children[2].textContent = dogInfoObject[i].sex;

            if (dogInfoObject[i].litter === true)
            {
                info.children[3].classList.remove("hidden");
                info.children[3].href = dogInfoObject[i].name.toLowerCase() + '1.php';
            }
            else
            {
                info.children[3].classList.add("hidden");
            }
            
            
            info.children[4].rel = dogInfoObject[i].name.toLowerCase();
            info.children[4].href = "/src/img/dogs/" + dogInfoObject[i].imageName;

            image.src = "/src/img/dogs/" + dogInfoObject[i].imageName;
            image.alt = dogInfoObject[i].name;
        }
    };
}

const dogNameCatch = (e) => {
    let figureId = e.target.closest('a').dataset.dogName.toLowerCase();
    console.log(figureId);
    createBlock(figureId);
}

document.addEventListener("click", dogNameCatch);


