import.meta.glob(['../images/**', '../fonts/**'])

// Fix simple pour les boutons "Enlever" des coupons
document.addEventListener('DOMContentLoaded', function() {
    // Quand on clique sur "Enlever" un coupon
    document.addEventListener('click', function(e) {
        const removeLink = e.target.closest('.woocommerce-remove-coupon');
        if (removeLink && removeLink.href && removeLink.href !== '#') {
            e.preventDefault();
            
            // Récupérer le code du coupon
            const couponCode = removeLink.getAttribute('data-coupon');
            
            // Rediriger vers l'URL avec le paramètre de suppression
            const url = new URL(window.location);
            url.searchParams.set('remove_coupon', couponCode);
            
            // Redirection immédiate
            window.location.href = url.toString();
        }
    });
});
