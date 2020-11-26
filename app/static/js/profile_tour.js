const tour = new Shepherd.Tour({
    defaultStepOptions: {
        classes: 'shadow-md bg-purple-dark',
        scrollTo: {
            behavior: 'smooth',
            block: 'center'
        }
    }
});

tour.addStep({
    title: 'Welcome!',
    text: `Calendar will help you track your, work, studies, fitness or any custom category and give you insights on your hard work.`,
    attachTo: {
        on: 'center'
    },
    buttons: [{
        action() {
            $('#userNavLink').click();
            return this.next();
        },
        text: 'Next'
    }],
    id: 'creating'
});

tour.addStep({
    title: 'Profile',
    text: `This page is your profile and you'll be able to keep track of your chores, categories and events. Also, you can add other users to complete tasks together.`,
    attachTo: {
        element: '#userNavLink',
        on: 'top'
    },
    buttons: [{
        action() {
            return this.next();
        },
        text: 'Next',
    }],
    id: 'creating'
});

tour.addStep({
    title: 'Add',
    text: `Start by creating a category.`,
    attachTo: {
        element: '#addNavLink',
        on: 'top'
    },
    buttons: [{
        action() {
            $('.shepherd-modal-overlay-container').css('display', 'none');
            window.location.href = "http://localhost/calendar/add_category.php";
            return this.next();
        },
        text: 'Next',
    }],
    id: 'creating'
});

if (<?php echo $_SESSION['guide'] ?> == 0) {
    tour.start();
    $('.shepherd-modal-overlay-container').css('display', 'visable');
} else {
    $('.shepherd-modal-overlay-container').css('display', 'none');
}