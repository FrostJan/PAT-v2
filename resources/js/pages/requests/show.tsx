import { StatusBadge } from '@/components/request/status-badge';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type FacilityRequestDetail } from '@/types';
import { Head, Link } from '@inertiajs/react';

interface Props {
    request: FacilityRequestDetail;
}

export default function RequestShow({ request }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Calendar', href: '/dashboard' },
        { title: 'Requests', href: '/requests' },
        { title: `#${request.id}`, href: `/requests/${request.id}` },
    ];

    const serviceEntries = Object.entries(request.services ?? {}).filter(([, v]) => v);
    const classificationEntries = Object.entries(request.classification ?? {}).filter(([, v]) => v);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Request #${request.id}`} />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <div className="flex items-center justify-between">
                    <h1 className="text-2xl font-bold tracking-tight">Request details</h1>
                    <StatusBadge status={request.status} />
                </div>

                <div className="grid gap-4 rounded-xl border bg-background p-6 md:grid-cols-2">
                    <Field label="Department" value={request.department} />
                    <Field label="Activity / Purpose" value={request.activity_purpose ?? '-'} />
                    <Field label="Division" value={request.division ?? '-'} />
                    <Field label="Attendees" value={String(request.attendees ?? '-')} />
                    <Field label="Date filed" value={request.date_filed ?? '-'} />
                    <Field label="Date needed" value={request.date_needed ?? '-'} />
                    <Field label="Time" value={`${request.time_needed_start ?? ''} – ${request.time_needed_end ?? ''}`} />
                    <Field label="Person in-charge" value={request.person_in_charge} />
                    <Field label="Contact" value={request.contact_number ?? '-'} />
                    <Field label="Submitted by" value={request.user?.name ?? '-'} />
                </div>

                <div className="grid gap-4 rounded-xl border bg-background p-6 md:grid-cols-2">
                    <div>
                        <h3 className="mb-2 font-semibold">Services requested</h3>
                        <ul className="list-disc pl-5">
                            {serviceEntries.length === 0 && <li className="text-muted-foreground">None</li>}
                            {serviceEntries.map(([k]) => (
                                <li key={k}>{prettyKey(k)}</li>
                            ))}
                        </ul>
                    </div>
                    <div>
                        <h3 className="mb-2 font-semibold">Classification</h3>
                        <ul className="list-disc pl-5">
                            {classificationEntries.length === 0 && <li className="text-muted-foreground">None</li>}
                            {classificationEntries.map(([k]) => (
                                <li key={k}>{prettyKey(k)}</li>
                            ))}
                        </ul>
                    </div>
                </div>

                {request.attachment_url && (
                    <div className="rounded-xl border bg-background p-6">
                        <h3 className="mb-2 font-semibold">Attachment</h3>
                        <Button asChild variant="outline">
                            <a href={request.attachment_url} target="_blank" rel="noreferrer noopener">
                                {request.attachment_name ?? 'Download'}
                            </a>
                        </Button>
                    </div>
                )}

                {request.decided_at && (
                    <p className="text-sm text-muted-foreground">
                        Decision by {request.decided_by?.name ?? 'unknown'} on {new Date(request.decided_at).toLocaleString()}
                    </p>
                )}

                <div>
                    <Button asChild variant="ghost">
                        <Link href="/requests">← Back to requests</Link>
                    </Button>
                </div>
            </div>
        </AppLayout>
    );
}

function Field({ label, value }: { label: string; value: string }) {
    return (
        <div>
            <p className="text-xs uppercase tracking-wide text-muted-foreground">{label}</p>
            <p className="font-medium">{value}</p>
        </div>
    );
}

function prettyKey(k: string): string {
    return k.replace(/_/g, ' ').replace(/\b\w/g, (c) => c.toUpperCase());
}
