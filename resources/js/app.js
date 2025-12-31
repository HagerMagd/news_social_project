import './bootstrap';
import jQuery, { event } from 'jquery';
window.$ = window.jQuery = jQuery;

// id variable coming from script tag in app.blade.php -> at layout folder=> (auth()->user()->id)
window.Echo.private("users." + id)
    .notification((event) => {
         $('#push-notifications .text-center').remove();
        $('#push-notifications').prepend(` 
            <div class="dropdown-item d-flex justify-content-between align-items-center">
            <span> Post comment: ${event.post_title.substring(0,9)}...</span>
            <a href="${event.url}?notify=${event.id}"><i
                class="fa fa-eye" aria-hidden="true">
            </i> </a>

        </div>
        `);
        //make count-notificatios 
        count = Number($('#count-notifications').text());
        count++;
        $('#count-notifications').text(count);
    });


