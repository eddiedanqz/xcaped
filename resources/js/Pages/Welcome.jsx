import React from "react";
import { Head, Link, useForm } from "@inertiajs/inertia-react";
import Guest from "@/Layouts/Guest";
import Button from "@/Components/Button";
import { InfoCard, CheckCircle } from "../Components/index";

export default function Welcome(props) {
    return (
        <>
            <Head title="Welcome" />
            <Guest auth={props.auth}>
                <div className="flex justify-center flex-wrap max-w-7xl px-5 pt-5 pb-0 mt-2 sm:mt-6 sm:items-center">
                    <div className="flex flex-col justify-between items-center sm:px-8 sm:py-4  md:flex-row">
                        <div className="relative mx-auto space-y-8 p-3">
                            <h1 className="text-gray-900 font-bold text-3xl lg:text-5xl">
                                Create your personal events and invite your
                                friends nearby.
                            </h1>
                            <p className="text-gray-800 font-semibold text-lg">
                                Discover upcoming local events and outdoor
                                activites in your city <br /> and nearby places
                                and get interesting event recommendations.
                            </p>
                            <div className="flex flex-row space-x-5">
                                <Button
                                    type="submit"
                                    className="peach-gradient rounded-sm shadow-lg"
                                >
                                    Get The App
                                </Button>
                                <Button
                                    type="button"
                                    className="bg-transparent text-primary border border-primary rounded-sm shadow-lg
                        active:bg-gray-100"
                                >
                                    Sign Up
                                </Button>
                            </div>
                        </div>
                        <div className="relative flex justify-center mx-auto mt-10 w-full sm:mt-0">
                            <div
                                className="absolute top-0 -right-5 w-64 h-64 peach-gradient rounded-full
                 mix-blend-multiply filter blur-xl opacity-60"
                            ></div>
                            <div
                                className="absolute bottom-10 left-10 w-52 h-52 peach-gradient rounded-full
                 mix-blend-multiply filter blur-xl opacity-60"
                            ></div>
                            <div className="relative m-8">
                                <div className="shadow-2xl rounded-3xl h-full">
                                    <img
                                        src="/storage/img/Tickets.png"
                                        className="h-[400px] w-full relative"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="flex flex-wrap my-10 sm:py-14 sm:px-8">
                        <h3 className="text-gray-900 w-full font-bold border-b my-8 mx-1">
                            How it works
                        </h3>
                        <div className="flex flex-col items-center sm:flex-row sm:mt-10 sm:justify-between">
                            <InfoCard
                                label="Easy to work"
                                icon={
                                    <CheckCircle
                                        className="h-[22px] w-auto"
                                        color="#ff8552"
                                    />
                                }
                                content="We beleieve that an easy to use hassle-free experience is essential
                        to make your attendees satisfied"
                            />
                            <InfoCard
                                label="Works on every device"
                                icon={
                                    <CheckCircle
                                        className="h-[22px] w-auto"
                                        color="#ff8552"
                                    />
                                }
                                content="Create your own events in minutes, and it becomes instantly available on both
                        major mobile platforms, IOS and Android."
                            />
                            <InfoCard
                                label="Instant access"
                                icon={
                                    <CheckCircle
                                        className="h-[22px] w-auto"
                                        color="#ff8552"
                                    />
                                }
                                content=" With our cloud based systems, the changes you make to your events are instantly
                        available to your attendees."
                            />
                        </div>
                    </div>

                    <section className="flex flex-col mb-10 sm:py-24 relative sm:px-8">
                        <div
                            className="absolute z-[0] w-52 h-52 -right-[50px] rounded-full peach-gradient bottom-0
                opacity-30 filter blur-3xl lg:w-80 lg:h-80"
                        />
                        <div className="flex flex-col justify-center items-center p-3 mb-5 z-[1]">
                            <h3 className="font-bold text-3xl text-gray-900 text-center">
                                Some Of The Best Features
                            </h3>
                            <p className="my-3 text-[16px] sm:text-center font-normal sm:w-6/12">
                                Discover upcoming nearby events and places,
                                outdoor activites and get interesting event
                                recommendations.
                            </p>
                        </div>
                        <div className="flex flex-col items-center sm:flex-row sm:justify-between z-[1]">
                            <div className="">
                                <InfoCard
                                    label="Create Event"
                                    cardStyle="sm:text-right"
                                    headerStyle="sm:flex-row-reverse"
                                    content="Create your own events in minutes, and it becomes instantly available on both
                        major mobile platforms, IOS and Android."
                                />
                                <InfoCard
                                    label="Discover nearby events and activities"
                                    cardStyle="sm:text-right"
                                    headerStyle="sm:flex-row-reverse"
                                    content="Discover upcoming local events and outdoor activites in your city
                        and nearby places and get interesting event recommendations."
                                />
                            </div>
                            <div className="hidden justify-center w-full sm:flex">
                                <div className="rounded-3xl shadow-2xl h-96 w-auto">
                                    <img
                                        src="/storage/img/Tickets.png"
                                        className="h-full w-auto"
                                    />
                                </div>
                            </div>
                            <div className="">
                                <InfoCard
                                    label="Notification"
                                    content="Create your own events in minutes, and it becomes instantly available on both
                        major mobile platforms, IOS and Android."
                                />
                                <InfoCard
                                    label="Buy event tickets"
                                    content="Create your own events in minutes, and it becomes instantly available on both
                        major mobile platforms, IOS and Android."
                                />
                            </div>
                        </div>
                    </section>
                    {/** */}
                    <section className="py-10 bg-white sm:py-16 lg:py-24">
                        <div className="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                            <div className="grid items-center grid-cols-1 gap-y-12 lg:grid-cols-2 lg:gap-x-24">
                                <div>
                                    <img
                                        className="w-full max-w-md mx-auto"
                                        src="https://cdn.rareblocks.xyz/collection/celebration/images/integration/2/services-icons.png"
                                        alt=""
                                    />
                                </div>

                                <div className="text-center lg:text-left">
                                    <h2 className="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl">
                                        Discover more events.
                                    </h2>
                                    <p className="mt-6 text-base text-gray-600">
                                        With our advanced search filtering, find
                                        the best place for a night out with
                                        freinds and family.Host and share events
                                        on all your socials.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                {/**Call To Action */}
                <section className="bg-red-600 mt-10 2xl:pt-24 2xl:bg-white">
                    <div className="px-4 mx-auto overflow-hidden bg-black w-full sm:px-6 lg:px-8">
                        <div className="py-10 sm:py-16 lg:py-20 2xl:pl-20">
                            <div className="grid items-center grid-cols-1 gap-y-12 lg:grid-cols-2 lg:gap-x-8 2xl:gap-x-20">
                                <div>
                                    <h2 className="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl lg:leading-tight">
                                        Use mobile app for better performance
                                    </h2>
                                    <p className="mt-4 text-base text-gray-50">
                                        Amet minim mollit non deserunt ullamco
                                        est sit aliqua dolor do amet sint. Velit
                                        officia consequat duis enim velit
                                        mollit. Exercitation veniam consequat
                                        sunt nostrud amet.
                                    </p>

                                    <div className="flex flex-row items-center mt-8 space-x-4 lg:mt-12">
                                        <a
                                            href="#"
                                            title=""
                                            className="flex"
                                            role="button"
                                        >
                                            <img
                                                className="w-auto h-14"
                                                src="https://cdn.rareblocks.xyz/collection/celebration/images/cta/8/btn-app-store.svg"
                                                alt=""
                                            />
                                        </a>

                                        <a
                                            href="#"
                                            title=""
                                            className="flex"
                                            role="button"
                                        >
                                            <img
                                                className="w-auto h-14"
                                                src="https://cdn.rareblocks.xyz/collection/celebration/images/cta/8/btn-play-store.svg"
                                                alt=""
                                            />
                                        </a>
                                    </div>
                                </div>

                                <div className="relative px-12">
                                    <svg
                                        className="absolute inset-x-0 bottom-0 left-1/2 -translate-x-1/2 -mb-48 lg:-mb-72 text-yellow-300 w-[460px] h-[460px] sm:w-[600px] sm:h-[600px]"
                                        fill="currentColor"
                                        viewBox="0 0 8 8"
                                    >
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    <img
                                        className="relative w-full max-w-xs mx-auto -mb-60 lg:-mb-64"
                                        src="https://cdn.rareblocks.xyz/collection/celebration/images/cta/8/iphone-mockup.png"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section className="py-8 px-0 mx-0 bg-gray-100 w-full">
                    <div className="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                        <div className="text-center xl:flex xl:items-center xl:justify-between xl:text-left">
                            <div className="xl:flex xl:items-center xl:justify-start">
                                <p className="mt-5 text-sm text-gray-500 xl:ml-6 xl:mt-0">
                                    © Copyright 2023 Xcaped
                                </p>
                            </div>

                            <div className="items-center mt-8 xl:mt-0 xl:flex xl:justify-end xl:space-x-8">
                                <ul className="flex flex-wrap items-center justify-center gap-x-8 gap-y-3 xl:justify-end">
                                    <li>
                                        <a
                                            href="#"
                                            title=""
                                            className="text-sm text-gray-600 transition-all duration-200 hover:text-opacity-80 focus:text-opacity-80"
                                        >
                                            {" "}
                                            About{" "}
                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            href="#"
                                            title=""
                                            className="text-sm text-gray-600 transition-all duration-200 hover:text-opacity-80 focus:text-opacity-80"
                                        >
                                            {" "}
                                            Privacy Policy{" "}
                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            href="#"
                                            title=""
                                            className="text-sm text-gray-600  transition-all duration-200 hover:text-opacity-80 focus:text-opacity-80"
                                        >
                                            {" "}
                                            Terms & Conditions{" "}
                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            href="#"
                                            title=""
                                            className="text-sm text-gray-600  transition-all duration-200 hover:text-opacity-80 focus:text-opacity-80"
                                        >
                                            {" "}
                                            Support{" "}
                                        </a>
                                    </li>
                                </ul>

                                <div className="w-full h-px mt-8 mb-5 xl:w-px xl:m-0 xl:h-6 bg-gray-50/20"></div>

                                <ul className="flex items-center justify-center space-x-8 xl:justify-end">
                                    <li>
                                        <a
                                            href="#"
                                            title=""
                                            className="block text-gray-700  transition-all duration-200 hover:text-opacity-80 focus:text-opacity-80"
                                        >
                                            <svg
                                                className="w-6 h-6"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                            >
                                                <path d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"></path>
                                            </svg>
                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            href="#"
                                            title=""
                                            className="block text-gray-700  transition-all duration-200 hover:text-opacity-80 focus:text-opacity-80"
                                        >
                                            <svg
                                                className="w-6 h-6"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                            >
                                                <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path>
                                            </svg>
                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            href="#"
                                            title=""
                                            className="block text-gray-700  transition-all duration-200 hover:text-opacity-80 focus:text-opacity-80"
                                        >
                                            <svg
                                                className="w-6 h-6"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                fill="currentColor"
                                            >
                                                <path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path>
                                                <circle
                                                    cx="16.806"
                                                    cy="7.207"
                                                    r="1.078"
                                                ></circle>
                                                <path d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </Guest>
        </>
    );
}
