import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useForm } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

interface Props {
    departments: string[];
    activityPurposes: { id: number; name: string }[];
}

type FormData = {
    department: string;
    activity_purpose_id: string;
    division: string;
    attendees: string;
    date_filed: string;
    date_needed: string;
    time_needed_start: string;
    time_needed_end: string;
    person_in_charge: string;
    contact_number: string;
    services: { pat: boolean; emc_room: boolean; tv_room: boolean };
    classification: {
        institutional: boolean;
        curricular: boolean;
        co_curricular: boolean;
        extra_curricular: boolean;
        outside_group: boolean;
    };
    attachment: File | null;
};

export function FacilityRequestForm({ departments, activityPurposes }: Props) {
    const [fileName, setFileName] = useState<string>('');

    const { data, setData, post, processing, errors, progress } = useForm<FormData>({
        department: '',
        activity_purpose_id: '',
        division: '',
        attendees: '',
        date_filed: new Date().toISOString().slice(0, 10),
        date_needed: '',
        time_needed_start: '',
        time_needed_end: '',
        person_in_charge: '',
        contact_number: '',
        services: { pat: false, emc_room: false, tv_room: false },
        classification: {
            institutional: false,
            curricular: false,
            co_curricular: false,
            extra_curricular: false,
            outside_group: false,
        },
        attachment: null,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post('/requests', { forceFormData: true });
    };

    return (
        <form onSubmit={submit} className="space-y-8 rounded-xl border bg-background p-6">
            <div className="grid gap-6 md:grid-cols-2">
                <div className="space-y-2">
                    <Label htmlFor="department">Department</Label>
                    <Select value={data.department} onValueChange={(v) => setData('department', v)}>
                        <SelectTrigger id="department">
                            <SelectValue placeholder="Select department" />
                        </SelectTrigger>
                        <SelectContent>
                            {departments.map((d) => (
                                <SelectItem key={d} value={d}>
                                    {d}
                                </SelectItem>
                            ))}
                        </SelectContent>
                    </Select>
                    {errors.department && <p className="text-sm text-red-600">{errors.department}</p>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="activity_purpose">Activity / Purpose</Label>
                    <Select value={data.activity_purpose_id} onValueChange={(v) => setData('activity_purpose_id', v)}>
                        <SelectTrigger id="activity_purpose">
                            <SelectValue placeholder="Select activity" />
                        </SelectTrigger>
                        <SelectContent>
                            {activityPurposes.map((p) => (
                                <SelectItem key={p.id} value={String(p.id)}>
                                    {p.name}
                                </SelectItem>
                            ))}
                        </SelectContent>
                    </Select>
                    {errors.activity_purpose_id && <p className="text-sm text-red-600">{errors.activity_purpose_id}</p>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="division">Division</Label>
                    <Input id="division" value={data.division} onChange={(e) => setData('division', e.target.value)} />
                    {errors.division && <p className="text-sm text-red-600">{errors.division}</p>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="attendees">Number of attendees</Label>
                    <Input
                        id="attendees"
                        type="number"
                        min={1}
                        value={data.attendees}
                        onChange={(e) => setData('attendees', e.target.value)}
                    />
                    {errors.attendees && <p className="text-sm text-red-600">{errors.attendees}</p>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="date_filed">Date filed</Label>
                    <Input
                        id="date_filed"
                        type="date"
                        value={data.date_filed}
                        onChange={(e) => setData('date_filed', e.target.value)}
                    />
                    {errors.date_filed && <p className="text-sm text-red-600">{errors.date_filed}</p>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="date_needed">Date needed</Label>
                    <Input
                        id="date_needed"
                        type="date"
                        value={data.date_needed}
                        onChange={(e) => setData('date_needed', e.target.value)}
                    />
                    {errors.date_needed && <p className="text-sm text-red-600">{errors.date_needed}</p>}
                </div>

                <div className="space-y-2">
                    <Label>Time needed</Label>
                    <div className="flex items-center gap-2">
                        <Input
                            type="time"
                            value={data.time_needed_start}
                            onChange={(e) => setData('time_needed_start', e.target.value)}
                            aria-label="Time start"
                        />
                        <span className="text-muted-foreground">to</span>
                        <Input
                            type="time"
                            value={data.time_needed_end}
                            onChange={(e) => setData('time_needed_end', e.target.value)}
                            aria-label="Time end"
                        />
                    </div>
                    {(errors.time_needed_start || errors.time_needed_end) && (
                        <p className="text-sm text-red-600">{errors.time_needed_start ?? errors.time_needed_end}</p>
                    )}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="person_in_charge">Person in-charge</Label>
                    <Input
                        id="person_in_charge"
                        value={data.person_in_charge}
                        onChange={(e) => setData('person_in_charge', e.target.value)}
                    />
                    {errors.person_in_charge && <p className="text-sm text-red-600">{errors.person_in_charge}</p>}
                </div>

                <div className="space-y-2">
                    <Label htmlFor="contact_number">Contact number</Label>
                    <Input
                        id="contact_number"
                        value={data.contact_number}
                        onChange={(e) => setData('contact_number', e.target.value)}
                    />
                    {errors.contact_number && <p className="text-sm text-red-600">{errors.contact_number}</p>}
                </div>
            </div>

            <div className="space-y-4">
                <h3 className="font-semibold">Services to be provided</h3>
                <div className="grid gap-3 sm:grid-cols-3">
                    {(['pat', 'emc_room', 'tv_room'] as const).map((key) => (
                        <label key={key} className="flex items-center gap-2">
                            <Checkbox
                                checked={data.services[key]}
                                onCheckedChange={(v) =>
                                    setData('services', { ...data.services, [key]: Boolean(v) })
                                }
                            />
                            <span>{labelFor(key)}</span>
                        </label>
                    ))}
                </div>
            </div>

            <div className="space-y-4">
                <h3 className="font-semibold">Classification of activity</h3>
                <div className="grid gap-3 sm:grid-cols-3">
                    {(['institutional', 'curricular', 'co_curricular', 'extra_curricular', 'outside_group'] as const).map((key) => (
                        <label key={key} className="flex items-center gap-2">
                            <Checkbox
                                checked={data.classification[key]}
                                onCheckedChange={(v) =>
                                    setData('classification', { ...data.classification, [key]: Boolean(v) })
                                }
                            />
                            <span>{labelFor(key)}</span>
                        </label>
                    ))}
                </div>
            </div>

            <div className="space-y-2">
                <Label htmlFor="attachment">Attachment (PDF, DOC, image — max 10 MB)</Label>
                <Input
                    id="attachment"
                    type="file"
                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                    onChange={(e) => {
                        const file = e.target.files?.[0] ?? null;
                        setData('attachment', file);
                        setFileName(file?.name ?? '');
                    }}
                />
                {fileName && <p className="text-sm text-muted-foreground">Selected: {fileName}</p>}
                {progress && <p className="text-sm text-muted-foreground">Uploading: {progress.percentage}%</p>}
                {errors.attachment && <p className="text-sm text-red-600">{errors.attachment}</p>}
            </div>

            <div className="flex justify-end gap-2">
                <Button type="submit" disabled={processing}>
                    {processing ? 'Submitting…' : 'Submit request'}
                </Button>
            </div>
        </form>
    );
}

function labelFor(key: string): string {
    switch (key) {
        case 'pat':
            return 'PAT';
        case 'emc_room':
            return 'EMC Room';
        case 'tv_room':
            return 'TV Room';
        case 'institutional':
            return 'Institutional';
        case 'curricular':
            return 'Curricular';
        case 'co_curricular':
            return 'Co-curricular';
        case 'extra_curricular':
            return 'Extra-curricular';
        case 'outside_group':
            return 'Outside Group';
        default:
            return key;
    }
}
