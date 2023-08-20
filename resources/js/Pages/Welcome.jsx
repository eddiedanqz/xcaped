import React from "react";
import { Link, Head } from "@inertiajs/inertia-react";
import Guest from "@/Layouts/Guest";
import Button from "@/Components/Button";
import { InfoCard, CheckCircle } from "../Components/index";

export default function Welcome(props) {
    return (
        <>
            <Head title="Welcome" />
            <Guest auth={props.auth}>
                <div className="flex justify-center flex-wrap max-w-7xl p-5 mt-2 sm:mt-6 sm:items-center">
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
                                    type="button"
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

                    <div className="flex flex-wrap my-10 sm:px-8">
                        <h3 className="text-gray-900 w-full font-bold border-b my-8 mx-1">
                            How it works
                        </h3>
                        <div className="flex flex-col items-center sm:flex-row sm:justify-between">
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
                                label="Works on every device"
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
                    <section className="flex flex-col my-10 relative sm:px-8">
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
                </div>
            </Guest>
        </>
    );
}
