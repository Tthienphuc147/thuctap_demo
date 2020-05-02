function scrollToTopAnimate(scrollDuration) {
    var cosParameter = window.scrollY / 2,
        scrollCount = 0,
        oldTimestamp = performance.now();
    function step (newTimestamp) {
        scrollCount += Math.PI / (scrollDuration / (newTimestamp - oldTimestamp));
        if (scrollCount >= Math.PI) window.scrollTo(0, 0);
        if (window.scrollY === 0) return;
        window.scrollTo(0, Math.round(cosParameter + cosParameter * Math.cos(scrollCount)));
        oldTimestamp = newTimestamp;
        window.requestAnimationFrame(step);
    }
    window.requestAnimationFrame(step);
}

function removeElement(elementId) {
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}

function formatNumberThousand(num) {
    num = Math.round(num/1000)*1000
    return (
        num
          .toFixed()
          .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    )
}

 function khongNhapKyTu(evt) { 
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function refreshPage(){
    location.reload();
}

function showMenu(icon,countHoTro){
    if(countHoTro > 0){
        $.ajax({
            type: 'POST',
            url: 'quantri/chamsockhachhang/hotro/changeiswatched',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                console.log(response)
                if(response.status){
                    icon.setAttribute('onclick', 'showMenu(this, 0)')
                } else {
                    Lobibox.notify('error', {
                        size: 'mini',
                        msg: "Lỗi cập nhật dữ liệu."
                    });
                }
            },
            error: (error) => {
                Lobibox.notify('error', {
                    size: 'mini',
                    msg: "Lỗi không kết nối được với cơ sở dữ liệu."
                });
            }
        })
    }
    $(icon).removeClass('text-warning')
}