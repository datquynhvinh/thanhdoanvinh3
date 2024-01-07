var TabPictureView = {
    classPreview    : ".preview_img",
    elmGirdImg      : ".list_grid_img",
    elmGirdItem     : ".gird_img_item",
    elmSlidePreview : ".slider_preview_img",
    elmClosePreview : ".close_preview_img",
    slickActive     : null,

    unSlick: function(elm = null) {
        if (elm == null) {
            elm = this.slickActive;
        }
        elm.slick('unslick');
    },

    setSlick: function(elmSetSlick) {
        this.slickActive = $(elmSetSlick).slick({
            dots: true,
            slidesToShow: 1,
        });
    },

    openPreview: function(elmClick) {
        var elementPreview = $(elmClick).find(this.classPreview);
        var sliderPreview = elementPreview.find(this.elmSlidePreview);
        elementPreview.show();
        this.setSlick(sliderPreview);
    },

    closePreview : function(elmClick){
        this.unSlick();
        $(elmClick).closest(this.classPreview).hide();
    },

    setClickLibraryPicture : function(){
        $(this.elmGirdImg).on('click', this.elmGirdItem, function(e) {
            if($(e.target).hasClass(TabPictureView.classPreview) || $(e.target).closest(TabPictureView.classPreview).length > 0){
                return true;
            }
            TabPictureView.openPreview(this);
        });
        $(this.elmGirdImg).on('click', this.elmClosePreview, function() {
            TabPictureView.closePreview(this);
        });
    }
}

TabPictureView.setClickLibraryPicture();

/**/

var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "choose_seemore span":*/
x = document.getElementsByClassName("choose_seemore span");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
  });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);