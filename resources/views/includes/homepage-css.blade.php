<style>
    @import url("https://fonts.googleapis.com/css?family=Cardo:400i|Rubik:400,700&display=swap");

    :root {
        --d: 700ms;
        --e: cubic-bezier(0.19, 1, 0.22, 1);
        --font-sans: "Rubik", sans-serif;
        --font-serif: "Cardo", serif;
    }

    * {
        box-sizing: border-box;
    }



    .page-content {
        display: grid;
        grid-gap: 1rem;
        padding: 1rem;
        /* max-width: 1024px; */
        margin: 0 auto;
        font-family: var(--font-sans);
    }


    @media (min-width: 600px) {
        .page-content {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 800px) {
        .page-content {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .card {
        border-radius: 15px;
        position: relative;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
        padding: 1rem;
        width: 100%;
        text-align: center;
        color: whitesmoke;
        background-color: whitesmoke;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1), 0 2px 2px rgba(0, 0, 0, 0.1), 0 4px 4px rgba(0, 0, 0, 0.1), 0 8px 8px rgba(0, 0, 0, 0.1), 0 16px 16px rgba(0, 0, 0, 0.1);
    }

    @media (min-width: 600px) {
        .card {
            height: 450px;
        }
    }

    .card:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 110%;
        background-size: cover;
        background-position: 0 0;
        transition: transform calc(var(--d) * 1.5) var(--e);
        pointer-events: none;
    }

    .card:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 200%;
        pointer-events: none;
        /* background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.009) 11.7%, rgba(0, 0, 0, 0.034) 22.1%, rgba(0, 0, 0, 0.072) 31.2%, rgba(0, 0, 0, 0.123) 39.4%, rgba(0, 0, 0, 0.182) 46.6%, rgba(0, 0, 0, 0.249) 53.1%, rgba(0, 0, 0, 0.32) 58.9%, rgba(0, 0, 0, 0.394) 64.3%, rgba(0, 0, 0, 0.468) 69.3%, rgba(0, 0, 0, 0.54) 74.1%, rgba(0, 0, 0, 0.607) 78.8%, rgba(0, 0, 0, 0.668) 83.6%, rgba(0, 0, 0, 0.721) 88.7%, rgba(0, 0, 0, 0.762) 94.1%, rgba(0, 0, 0, 0.79) 100%); */
        transform: translateY(-50%);
        transition: transform calc(var(--d) * 2) var(--e);
    }

    .card:nth-child(1):before {
        background-image: url({{ $meganews->meganews_images->first()->image[0] == 'h' ? $meganews->meganews_images->first()->image : 'https://meganet-admin.portalwebsite.net/uploads/Meganews-Images/' . $meganews->meganews_images->first()->image }});
        filter: blur(3px);
        background-position: center;
    }

    .card:nth-child(2):before {
        background-image: url({{ $megagoodVibes->thumbnail[0] == 'h' ? $megagoodVibes->thumbnail : 'https://meganet-admin.portalwebsite.net/uploads/MegaGoodVibes-Thumbnail/' . $megagoodVibes->thumbnail }});
        filter: blur(3px);
        background-position: center;
    }

    .card:nth-child(3):before {
        background-image: url({{ $megatrivia->image }});
        filter: blur(3px);
        background-position: center;
    }

    .card:nth-child(4):before {
        background-image: url({{ asset('images/megaprojects/residential1.png') }});
        filter: blur(3px);
        background-position: center;
    }

    .card-content {
        /* position: relative; */
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        padding: 1rem;
        transition: transform var(--d) var(--e);
        z-index: 1;
    }

    .title {
        font-size: 1.3rem;
        font-weight: bold;
        /* line-height: 1.2; */
        color: white !important;
        font-family: 'Montserrat-Bold';
        background-color: #00000054;
        border-radius: 15px;
        padding: 0px 10px;
    }

    .btn:focus {
        outline: 1px dashed yellow;
        outline-offset: 3px;
    }

    @media (hover: hover) and (min-width: 600px) {
        .card:after {
            transform: translateY(0);
        }

        .card-content {
            transform: translateY(calc(100% - 4.5rem));
        }

        .card-content>*:not(.title) {
            opacity: 0;
            transform: translateY(1rem);
            transition: transform var(--d) var(--e), opacity var(--d) var(--e);
        }

        .card:hover,
        .card:focus-within {
            align-items: center;
        }

        .card:hover:before,
        .card:focus-within:before {
            transform: translateY(-4%);
            filter: blur(0px);
        }

        .card:hover:after,
        .card:focus-within:after {
            transform: translateY(-50%);
        }

        .card:hover .card-content>*:not(.title),
        .card:focus-within .card-content>*:not(.title) {
            opacity: 1;
            transform: translateY(0);
            transition-delay: calc(var(--d) / 8);
        }

        .card:focus-within:before,
        .card:focus-within:after,
        .card:focus-within .card-content,
        .card:focus-within .card-content>*:not(.title) {
            transition-duration: 0s;
        }
    }
</style>
