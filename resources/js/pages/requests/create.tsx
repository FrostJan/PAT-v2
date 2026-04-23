import { FacilityRequestForm } from '@/components/request/facility-request-form';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Calendar', href: '/dashboard' },
    { title: 'Facility Form', href: '/requests/create' },
];

interface Props {
    activityPurposes: { id: number; name: string }[];
    departments: string[];
}

export default function RequestCreate({ activityPurposes, departments }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Facility Request Form" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <h1 className="text-2xl font-bold tracking-tight">Common facility request form</h1>
                <FacilityRequestForm activityPurposes={activityPurposes} departments={departments} />
            </div>
        </AppLayout>
    );
}
