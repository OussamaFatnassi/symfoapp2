export async function sendRequest(url, input) {
    const response = await fetch(url);

    if (response.ok) {
        const data = await response.json();

        const textVisibility = input.closest('.card-body').querySelector('.text-visibility');

        if (data.visibility) {
            textVisibility.classList.remove('text-danger');
            textVisibility.classList.add('text-success');
            textVisibility.innerHTML = 'Actif';
        } else {
            textVisibility.classList.remove('text-success');
            textVisibility.classList.add('text-danger');
            textVisibility.innerHTML = 'Inactif';
        }
    } else {
        console.error(await response.json());
    }
}