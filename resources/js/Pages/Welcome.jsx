import React from 'react';
import { Link, Head } from '@inertiajs/inertia-react';
import Guest from '@/Layouts/Guest';

export default function Welcome(props) {
    return (
        <>
            <Head title="Welcome" />
            <Guest auth={props.auth}>
            <div className="relative flex items-top justify-center bg-gray-100 py-4 mt-6 dark:bg-gray-900 sm:items-center sm:pt-0">

                <div className="max-w-6xl mx-auto sm:px-6 lg:px-8">

                </div>
            </div>
            </Guest>
        </>
    );
}
