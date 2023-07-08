let thanksToResetBTN = document.getElementById('thanks_to_reset');
thanksToResetBTN.addEventListener('click', function(){
    const url = new URL(document.location);

    const searchParams = url.searchParams;

    searchParams.delete("department");
    searchParams.delete("date_to");
    searchParams.delete("date_from");

    location.href = url.toString();
});